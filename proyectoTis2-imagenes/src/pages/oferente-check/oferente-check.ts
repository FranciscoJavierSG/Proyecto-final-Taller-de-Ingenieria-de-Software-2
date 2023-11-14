import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
//import { LoginPage } from '../login/login';
import { Http } from '@angular/http';
//import { Observable } from 'rxjs';

/**
 * Generated class for the OferenteCheckPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-oferente-check',
  templateUrl: 'oferente-check.html',
})
export class OferenteCheckPage {

  constructor(public navCtrl: NavController, public navParams: NavParams,public http: Http) {
    //localStorage.clear();
    if('respuesta' in localStorage){
    var token=JSON.parse(localStorage.getItem('respuesta'));
    console.log(token);
    
    if(token.hasOwnProperty('data')){
      console.log(token.data.id_usuario);
      var a=token.data.id_usuario;

    //http://localhost/apiRest/public/oferente/
    //https://edein.cl/equipo2/apiRest/public/oferente/

      this.http.get("https://edein.cl/equipo2/apiRest/public/oferente/"+a)
      .map(Response=>Response.json())
      .subscribe(data =>{
        if(data==="No existen usuarios en la BBDD con este ID."){
          console.log("LLEGUE ACA Y ENTRE AL IF");
          console.log("NO ERES OFERENTE");
        }else{
          console.log("ENTRE AL ELSE");
          console.log("LLEVAR A CREAR PUBLICACION");
        }
      });
      
    }
  }
  }

  

  ionViewDidLoad() {
    console.log('ionViewDidLoad OferenteCheckPage');
  }

}