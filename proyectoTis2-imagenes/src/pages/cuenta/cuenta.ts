import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ToastController } from 'ionic-angular';
import { MisPublicacionesPage } from '../mis-publicaciones/mis-publicaciones';
import { HomePage } from '../home/home';
import { Observable } from 'rxjs';
import { Http } from '@angular/http';
import { LoginPage } from '../login/login';
import { MisPublicacionesGuardadasPage } from '../mis-publicaciones-guardadas/mis-publicaciones-guardadas';
import { HistorialPage } from '../historial/historial';
import { EditCuentaPage } from '../edit-cuenta/edit-cuenta';

@IonicPage()
@Component({
  selector: 'page-cuenta',
  templateUrl: 'cuenta.html',
})

export class CuentaPage {


  data:Observable<any>;
  id_usuario:any;
  nombre_usuario:any;
  email_usuario:any;
  cuenta: any;
  foto: any;


  constructor(public navCtrl: NavController, public navParams: NavParams, private http: Http, public toastCtrl: ToastController) {


    if('respuesta' in localStorage){
    var respuesta = JSON.parse(localStorage.getItem('respuesta'));
    var id_usuario = respuesta.data.id_usuario;
    console.log(id_usuario);  

    //http://localhost/apiRest/public/usuario/
    //https://edein.cl/equipo2/apiRest/public/usuario/
    this.http.get('https://edein.cl/equipo2/apiRest/public/usuario/'+id_usuario)
    .map(response => response.json())
    .subscribe(data => {
      this.cuenta = data;
      console.log(data);  
    },
    err => {
      console.log("Oops!");
    }
  );
  this.http.get('https://edein.cl/equipo2/apiRest/public/usuario_foto/'+id_usuario)
  .map(response => response.json())
  .subscribe(datas => {
    this.foto = datas;
    console.log(datas);  
  },
  err => {
    console.log("Oops!");
  }
);
  }else{
    this.irLogin();
  }

  }

  mensajeToast(msg) {
    const toast = this.toastCtrl.create({
      message: msg,
      duration: 3000
    });
    toast.present();
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad CuentaPage');
  }

  irMisPublicaciones(){
    this.navCtrl.push(MisPublicacionesPage);
  }

  irHome() {
    this.navCtrl.setRoot(HomePage);
  }

  irLogin() {
    this.navCtrl.setRoot(LoginPage);
  }

  cerrar(){
      localStorage.clear();
      this.irHome();
      this.mensajeToast("Se ha cerrado su sesión.");
  }

  PublicacionesGuardadas(){
    this.navCtrl.push(MisPublicacionesGuardadasPage);
  }

  Historial(){
    this.navCtrl.push(HistorialPage);
  }

  editarInfo(){
    this.navCtrl.push(EditCuentaPage);
  }

}