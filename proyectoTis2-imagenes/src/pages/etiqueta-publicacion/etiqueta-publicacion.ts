import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';

import { Http } from '@angular/http';
import 'rxjs/add/operator/map';
import { Observable } from 'rxjs/Observable';

import { PublicacionPage } from '../publicacion/publicacion';

/**
 * Generated class for the EtiquetaPublicacionPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-etiqueta-publicacion',
  templateUrl: 'etiqueta-publicacion.html',
})
export class EtiquetaPublicacionPage {
  publicaciones: any;
  data: Observable<any>;
  etiqueta = this.navParams.get('valor');

  constructor(public navCtrl: NavController, public navParams: NavParams, public http: Http) {
    //http://localhost/apiRest/public/etiqueta_publicacion/
    //https://edein.cl/equipo2/apiRest/public/etiqueta_publicacion/
    this.http.get('https://edein.cl/equipo2/apiRest/public/etiqueta_publicacion/'+this.etiqueta)
    .map(response => response.json())
    .subscribe(data =>
      {
        this.publicaciones = data;
        console.log(data);
      },
      err =>{
        console.log("Oops!");
      });
  }

  irPublicacion(id_publicacion){
    this.navCtrl.push(PublicacionPage, {valor: id_publicacion});
  }
  
  ionViewDidLoad() {
    console.log('ionViewDidLoad EtiquetaPublicacionPage');
    console.log(this.etiqueta);
  }

}
