import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { Http } from '@angular/http';
import { Observable } from 'rxjs';
import { PublicacionPage } from '../publicacion/publicacion';
import { CuentaPage } from '../cuenta/cuenta';
import { ToastController } from 'ionic-angular';
/**
 * Generated class for the MisPublicacionesGuardadasPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-mis-publicaciones-guardadas',
  templateUrl: 'mis-publicaciones-guardadas.html',
})
export class MisPublicacionesGuardadasPage {
  
  data:Observable<any>;
  id_usuario:any;
  publicacionesGuardadas: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public http: Http,private toastCtrl:ToastController) {
    
    
    var respuesta = JSON.parse(localStorage.getItem('respuesta'));
    var id_usuario = respuesta.data.id_usuario;
    console.log(id_usuario);  


    //http://localhost/apiRest/public/publicaciones_guardadas/
    //https://edein.cl/equipo2/apiRest/public/publicaciones_guardadas/
    this.http.get('https://edein.cl/equipo2/apiRest/public/publicaciones_guardadas/'+id_usuario)
    .map(response => response.json())
    .subscribe(data =>{
      
        this.publicacionesGuardadas = data;
        console.log(data);
      
          
      },
      err => {
        console.log("Oops!");
      }
    );
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad MisPublicacionesGuardadasPage');
  }

  irPublicacion(id_publicacion){
    this.navCtrl.push(PublicacionPage, {valor: id_publicacion});
  }

  limpiarGuardados() {

    if('respuesta' in localStorage){
      var respuesta = JSON.parse(localStorage.getItem('respuesta'));
      var id_usuario = respuesta.data.id_usuario;
      console.log(id_usuario);  


    //http://localhost/apiRest/public/guardar_publicacion/delete/
    //https://edein.cl/equipo2/apiRest/public/guardar_publicacion/delete/
    this.http.delete('https://edein.cl/equipo2/apiRest/public/guardar_publicacion/delete/'+id_usuario)
    .subscribe(data => {
      console.log(data);
      this.presentToast("Publicaciones guardas eliminadas");
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
