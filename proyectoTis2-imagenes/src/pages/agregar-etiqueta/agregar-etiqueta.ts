import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams, ToastController } from 'ionic-angular';
import { HomePage } from '../home/home';

import { Http } from '@angular/http';
import 'rxjs/add/operator/map';

@IonicPage()
@Component({
  selector: 'page-agregar-etiqueta',
  templateUrl: 'agregar-etiqueta.html',
})
export class AgregarEtiquetaPage {

  publicacion: any;
  publicacionesDes: any;
  etiqueta: any;
  id = this.navParams.get('valor');

  constructor(public navCtrl: NavController, public navParams: NavParams, public http: Http, public toastCtrl: ToastController) {
    console.log(this.id);
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad AgregarEtiquetaPage');
  }

  mensajeToast(msg) {
    const toast = this.toastCtrl.create({
      message: msg,
      duration: 3000
    });
    toast.present();
  }

  crearEtiqueta() {
    let postData = new FormData();
    postData.append('etiqueta', this.etiqueta);
    postData.append('id_publicacion', this.id);
    //http://localhost/apiRest/public/etiqueta/new
    //https://edein.cl/equipo2/apiRest/public/etiqueta/new
    this.http.post('https://edein.cl/equipo2/apiRest/public/etiqueta/new', postData)
      .map(response => response.json())
      .subscribe(data => {
        console.log(data);
        this.etiqueta = "";
        postData = null;
        this.mensajeToast('Etiqueta agregada.')
      },
        err => {
          console.log("Oops!");
          this.etiqueta = "";
          postData = null;

          this.mensajeToast('Etiqueta no válida.')
        }
      );
  }

  irHome() {
    this.navCtrl.setRoot(HomePage);
  }

}
