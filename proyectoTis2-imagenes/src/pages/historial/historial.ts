import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { PublicacionPage } from '../publicacion/publicacion';
import { Http } from '@angular/http';
import { Observable } from 'rxjs';
import { CuentaPage } from '../cuenta/cuenta';
import { ToastController } from 'ionic-angular';

/**
 * Generated class for the HistorialPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-historial',
  templateUrl: 'historial.html',
})
export class HistorialPage {
  
  data:Observable<any>;
  id_usuario:any;
  publicacionesHistorial: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public http: Http,private toastCtrl:ToastController) {

    var respuesta = JSON.parse(localStorage.getItem('respuesta'));
    var id_usuario = respuesta.data.id_usuario;
    console.log(id_usuario);  
    

    //http://localhost/apiRest/public/publicaciones_historial/
    //https://edein.cl/equipo2/apiRest/public/publicaciones_historial/
    this.http.get('https://edein.cl/equipo2/apiRest/public/publicaciones_historial/'+id_usuario)
    .map(response => response.json())
    .subscribe(data =>{
      
        this.publicacionesHistorial = data;
        console.log(data);
        
      },
      err => {
        console.log("Oops!");
      }
    );


  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad HistorialPage');
  }


  irPublicacion(id_publicacion){
    this.navCtrl.push(PublicacionPage, {valor: id_publicacion});
  }

  limpiarHistorial() {

    if('respuesta' in localStorage){
      var respuesta = JSON.parse(localStorage.getItem('respuesta'));
      var id_usuario = respuesta.data.id_usuario;
      console.log(id_usuario);  

    //http://localhost/apiRest/public/historial_publicacion/delete/
    //https://edein.cl/equipo2/apiRest/public/historial_publicacion/delete/
    this.http.delete('https://edein.cl/equipo2/apiRest/public/historial_publicacion/delete/'+id_usuario)
    .subscribe(data => {
      console.log(data);
      this.presentToast("Historial borrado");
      this.navCtrl.setRoot(CuentaPage);
    });
  
  }
}

presentToast(msg: string){
  let toast = this.toastCtrl.create({
    message: msg,
    duration: 2000,
  });
  toast.present();
}


}