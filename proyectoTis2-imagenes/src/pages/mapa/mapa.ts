import { Component } from '@angular/core';
import {  IonicPage, NavController, NavParams } from 'ionic-angular';

import { Http } from '@angular/http';
import 'rxjs/add/operator/map';

@IonicPage()
@Component({
  selector: 'page-mapa',
  templateUrl: 'mapa.html'
})
export class MapaPage {

  id_publicacion:any;

  direccionPub = this.navParams.get('direccionP');


  constructor(public navCtrl: NavController, public navParams: NavParams, public http: Http) {

    console.log("Direccion recibida: " + this.direccionPub);







  }
  


}
