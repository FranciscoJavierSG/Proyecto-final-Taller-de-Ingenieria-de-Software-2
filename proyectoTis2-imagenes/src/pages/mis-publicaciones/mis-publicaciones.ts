import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ToastController } from 'ionic-angular';

import { Http } from '@angular/http';
import 'rxjs/add/operator/map';
import { Observable } from 'rxjs/Observable';
import { LoginPage } from '../login/login';
import { PublicacionPage } from '../publicacion/publicacion';
import { HomePage } from '../home/home';
import { EliminarPublicacionPage } from '../eliminar-publicacion/eliminar-publicacion';
import { EditarPublicacionPage } from '../editar-publicacion/editar-publicacion';

/**
 * Generated class for the MisPublicacionesPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-mis-publicaciones',
  templateUrl: 'mis-publicaciones.html',
})
export class MisPublicacionesPage {
  publicaciones: any;
  usuario: any;
  //oferente = this.navParams.get('valor');
  data: Observable<any>;
  constructor(public navCtrl: NavController, public navParams: NavParams, public http: Http, public toastCtrl: ToastController) {


    if ('respuesta' in localStorage) {
      var token = JSON.parse(localStorage.getItem('respuesta'));
      console.log(token);
      if (token.hasOwnProperty('data')) {
        console.log(token.data.id_usuario);
        var a = token.data.id_usuario;
        //http://localhost/apiRest/public/oferente/
        //https://edein.cl/equipo2/apiRest/public/oferente/
        this.http.get("https://edein.cl/equipo2/apiRest/public/oferente/" + a)   //OFERENTES
          .map(Response => Response.json())
          .subscribe(data => {
            if (data === "No existen usuarios en la BBDD con este ID.") { // TE LLEVA A OFERENTE-CHECK   logeado no oferente
              console.log("LLEGUE ACA Y ENTRE AL IF");
              console.log("NO ERES OFERENTE");
              this.irHome();

            } else {                                      // LLEVA AL FORMULARIO SI SE CUMPLE TODO
              console.log("ENTRE AL ELSE");
              console.log("LLEVAR A CREAR PUBLICACION");
              this.verPublicaciones(a);
            }
          });
      }


    } else {
      this.mensajeToast("Usted no ha iniciado sesión.");
      this.irLogin();
    }
  }

  verPublicaciones(a) {
    //Aca se saca el id_de usuario dependiendo si ta logeado
    //desde el Local Storage
    //Tiene que ser oferente si no lo lleva al login

    //http://localhost/apiRest/public/mis_publicaciones/
    //https://edein.cl/equipo2/apiRest/public/mis_publicaciones/
    this.http.get('https://edein.cl/equipo2/apiRest/public/mis_publicaciones/' + a)
      .map(response => response.json())
      .subscribe(data => {
        this.publicaciones = data;

        console.log(data);
      },
        err => {
          console.log("Oops!");
        }
      );
  }
  ionViewDidLoad() {
    console.log('ionViewDidLoad MisPublicacionesPage');
  }

  irHome(){
    this.mensajeToast("Usted no es oferente.");
    this.navCtrl.setRoot(HomePage);
  }

  irLogin() {
    this.mensajeToast("Usted no ha iniciado sesión.");
    this.navCtrl.setRoot(LoginPage);
  }

  irEliminarPublicacion(id_publicacion){
    this.navCtrl.push(EliminarPublicacionPage, { valor: id_publicacion });
  }

  irPublicacion(id_publicacion) {
    this.navCtrl.push(PublicacionPage, { valor: id_publicacion });
  }

  irEditarPublicacion(id_publicacion) {
    this.navCtrl.push(EditarPublicacionPage, { valor: id_publicacion });
  }

  mensajeToast(msg) {
    const toast = this.toastCtrl.create({
      message: msg,
      duration: 3000
    });
    toast.present();
  }
}
