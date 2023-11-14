import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';

import { Http } from '@angular/http';
import 'rxjs/add/operator/map';
import { Observable } from 'rxjs/Observable';

import { PublicacionPage } from '../publicacion/publicacion';

@IonicPage()
@Component({
  selector: 'page-publicaciones-oferente',
  templateUrl: 'publicaciones-oferente.html'
})
export class PublicacionesOferentePage {

  publicaciones:any;
  oferente = this.navParams.get('valor');
  data:Observable<any>;


  constructor(public navCtrl: NavController, public navParams: NavParams, public http: Http) {


    //http://localhost/apiRest/public/usuario_publicacion/
    //https://edein.cl/equipo2/apiRest/public/usuario_publicacion/
    this.http.get('https://edein.cl/equipo2/apiRest/public/usuario_publicacion/'+this.oferente)
    .map(response => response.json())
    .subscribe(data =>
      {
        this.publicaciones = data;

        console.log(data);
      },
      err => {
        console.log("Oops!");
      }
    );

  }

  irPublicacion(id_publicacion){
    this.navCtrl.push(PublicacionPage, {valor: id_publicacion});
  }
  
  ordenarPubAsc($event){
    if($event == "Asc"){
      console.log($event);
      //this.publicaciones.sort((a,b) => a.nombre_publicacion.localeCompare(b.nombre_publicacion));
      this.publicaciones.sort((a,b) => a.nombre_publicacion.toLowerCase() < b.nombre_publicacion.toLowerCase() ? -1 : a.nombre_publicacion.toLowerCase() > b.nombre_publicacion.toLowerCase() ? 1 : 0);
    }else if($event == "Des"){
      console.log($event);
      this.publicaciones.sort((a,b) =>  a.nombre_publicacion.toLowerCase() < b.nombre_publicacion.toLowerCase() ? 1 : a.nombre_publicacion.toLowerCase() > b.nombre_publicacion.toLowerCase() ? -1 : 0);   
    }else if($event == "MenP"){
      console.log($event);
      this.publicaciones.sort((a,b) =>  a.valor_publicacion < b.valor_publicacion ? -1 : a.valor_publicacion > b.valor_publicacion ? 1 : 0);   
    }else{
      console.log($event);
      this.publicaciones.sort((a,b) =>  a.valor_publicacion < b.valor_publicacion ? 1 : a.valor_publicacion > b.valor_publicacion ? -1 : 0);   
    }

  }
}