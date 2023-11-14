import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { LoginPage } from '../login/login';
import { Http } from '@angular/http';
import { Observable } from 'rxjs';
import { OferenteCheckPage } from '../oferente-check/oferente-check';
import { CrearPublicacionPage } from '../crear-publicacion/crear-publicacion';
/**
 * Generated class for the CrearPublicacionCheckPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-crear-publicacion-check',
  templateUrl: 'crear-publicacion-check.html',
})
export class CrearPublicacionCheckPage {
  
  data: Observable<any>;
  token: any;

  constructor(public navCtrl: NavController, public navParams: NavParams,public http: Http) {
    //localStorage.clear();

    if('respuesta' in localStorage){        //si esta logeado
    var token=JSON.parse(localStorage.getItem('respuesta'));
    console.log(token);
    
    if(token.hasOwnProperty('data')){   //solo si hay datos entra
      console.log(token.data.id_usuario);
      var a=token.data.id_usuario;
      //http://localhost/apiRest/public/oferente/
      //https://edein.cl/equipo2/apiRest/public/oferente/
      this.http.get("https://edein.cl/equipo2/apiRest/public/oferente/"+a)   //OFERENTES
      .map(Response=>Response.json())
      .subscribe(data =>{
        if(data==="No existen usuarios en la BBDD con este ID."){ // TE LLEVA A OFERENTE-CHECK   logeado no oferente
          console.log("LLEGUE ACA Y ENTRE AL IF");
          console.log("NO ERES OFERENTE");
          this.irOferente();
          
        }else{                                      // LLEVA AL FORMULARIO SI SE CUMPLE TODO
          console.log("ENTRE AL ELSE");
          console.log("LLEVAR A CREAR PUBLICACION");
          this.irCrear();
        }
      });
      
    }
  }
  }

  irCrear(){
    this.navCtrl.setRoot(CrearPublicacionPage);
  }
  
  irOferente() {
    this.navCtrl.setRoot(OferenteCheckPage);
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad CrearPublicacionCheckPage');
  }

  irLogeo(){
    this.navCtrl.push(LoginPage);
  }

}