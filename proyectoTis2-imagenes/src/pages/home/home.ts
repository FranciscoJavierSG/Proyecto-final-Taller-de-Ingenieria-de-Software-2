import { Component, OnInit } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { PublicacionPage } from '../publicacion/publicacion';
import { FiltroPage } from '../filtro/filtro';

import { Http } from '@angular/http';
import 'rxjs/add/operator/map';
import { Observable } from 'rxjs/Observable';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage implements OnInit{


  publicacionesDes: any;
  id_publicacion = this.navParams.get('valor');
  estado: any;
  data: Observable<any>;
  foto:any;
  fotos:any;
  id_pub:any;


  constructor(public navCtrl: NavController, public http: Http, public navParams: NavParams) {
    //http://localhost/apiRest/public/publicacion/destacadas
    //https://edein.cl/equipo2/apiRest/public/publicacion/destacadas/ 
    this.http.get('https://edein.cl/equipo2/apiRest/public/publicacion ')
      .map(response => response.json())
      .subscribe(data => {

        this.publicacionesDes = data;
        //this.imagen(data.id_publicacion);
        console.log(this.publicacionesDes);

      },
        err => {
          console.log("Oops!");
        }
      );
    
  }

  ngOnInit(){

  }

  irPublicacion(id_publicacion) {

    let postData = new FormData();

    if ('respuesta' in localStorage) {
      var respuesta = JSON.parse(localStorage.getItem('respuesta'));
      var id_usuario = respuesta.data.id_usuario;
      console.log(id_usuario);

      //http://localhost/apiRest/public/historial_publicacion/new
      //https://edein.cl/equipo2/apiRest/public/historial_publicacion/new/
      var url = 'https://edein.cl/equipo2/apiRest/public/historial_publicacion/new';

      postData.append('id_usuario', id_usuario);
      postData.append('id_publicacion', id_publicacion);
      this.data = this.http.post(url, postData);
      this.data.subscribe((data) => {
        console.log(data);
        this.navCtrl.push(PublicacionPage, { valor: id_publicacion });

      }), err => {
        console.log("Oops!");

      }
    }else{
      this.navCtrl.push(PublicacionPage, { valor: id_publicacion });
    }
  }

  irFiltro() {
    //this.navCtrl.setRoot(FiltroPage);
    this.navCtrl.push(FiltroPage);
  }

  ordenarPubAsc($event){
    if($event == "Asc"){
      console.log($event);
      //this.publicacionesDes.sort((a,b) => a.nombre_publicacion.localeCompare(b.nombre_publicacion));
      this.publicacionesDes.sort((a,b) => a.nombre_publicacion.toLowerCase() < b.nombre_publicacion.toLowerCase() ? -1 : a.nombre_publicacion.toLowerCase() > b.nombre_publicacion.toLowerCase() ? 1 : 0);
    }else if($event == "Des"){
      console.log($event);
      this.publicacionesDes.sort((a,b) =>  a.nombre_publicacion.toLowerCase() < b.nombre_publicacion.toLowerCase() ? 1 : a.nombre_publicacion.toLowerCase() > b.nombre_publicacion.toLowerCase() ? -1 : 0);   
    }else if($event == "MenP"){
      console.log($event);
      this.publicacionesDes.sort((a,b) =>  a.valor_publicacion < b.valor_publicacion ? -1 : a.valor_publicacion > b.valor_publicacion ? 1 : 0);   
    }else{
      console.log($event);
      this.publicacionesDes.sort((a,b) =>  a.valor_publicacion < b.valor_publicacion ? 1 : a.valor_publicacion > b.valor_publicacion ? -1 : 0);   
    }

  }

  ////////////////////////

}
