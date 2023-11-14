import { Component} from '@angular/core';
import { FormGroup } from '@angular/forms';
import { NavController, NavParams, ToastController } from 'ionic-angular';
import { BusquedaPage } from '../busqueda/busqueda';

import { Http } from '@angular/http';
import { Observable } from 'rxjs';
import 'rxjs/add/operator/map';



/**
 * Generated class for the FiltroPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@Component({
  selector: 'page-filtro',
  templateUrl: 'filtro.html',
})
export class FiltroPage {

  regiones:any;
  comunas:any;
  id_publicacion:any;
  regionS:any;

  datos: FormGroup;
  data: Observable<any>;

  nombreF: string = '';
  regionF: any;
  comunaF: any;
  tipoPF: any;
  tipoTF: any;

  nombreBusqueda: any;
  regionBusqueda: any;
  comunaBusqueda: any;
  tipoPubBusqueda: any;
  tipoTurBusqueda: any;


  publicacionesDes: any;


  constructor(public navCtrl: NavController, public http: Http, public navParams: NavParams, public toastCtrl: ToastController) {

    
    this.http.get('https://apis.digital.gob.cl/dpa/regiones')
    .map(response => response.json())
    .subscribe(data =>
      {
        this.regiones = data;
        console.log(data);
      },
      err => {
        console.log("Oops!");
      }
    );
   
  }

  onOptionsSelected(value:string){
    console.log("Region seleccionada tiene codigo " + value);

    this.http.get('https://apis.digital.gob.cl/dpa/regiones/'+value+'/comunas')
    .map(response => response.json())
    .subscribe(data2 =>
      {
        this.comunas = data2;
        console.log(data2);
      },
      err => {
        console.log("Oops!");
      }
    );
  }

  irBusqueda(){
    this.nombreBusqueda = this.nombreF;
    this.regionBusqueda = document.getElementById("regionF").innerText;
    this.comunaBusqueda = document.getElementById("comunaF").innerText;
    this.tipoPubBusqueda = document.getElementById("tipoPF").innerText;
    this.tipoTurBusqueda = document.getElementById("tipoTF").innerText;

    this.navCtrl.push(BusquedaPage, {nombreB: this.nombreBusqueda, regionB: this.regionBusqueda, comunaB: this.comunaBusqueda, tipoPB: this.tipoPubBusqueda, tipoTB: this.tipoTurBusqueda});

  }
  
  ionViewDidLoad() {
    console.log('ionViewDidLoad FiltroPage');
  }

  mensajeToast() {
    const toast = this.toastCtrl.create({
      message: 'Realizando busqueda',
      duration: 1500
    });
    toast.present();
  }
  
  /*buscarPublicaciones() {
    var url = 'http://localhost/apiRest/public/publicacion/buscar';
    let postData = new FormData();
  
    console.log("nombre_publicacion es: " + this.nombreF);
    console.log("region es: " + document.getElementById("regionF").innerText);
    console.log("comuna es: " + document.getElementById("comunaF").innerText);
  
    postData.append('nombre_publicacion', this.nombreF);
    postData.append("region_publicacion", document.getElementById("regionF").innerText);
    postData.append("comuna_publicacion", document.getElementById("comunaF").innerText);

    this.http.post(url, postData)
    .map(response => response.json())
    .subscribe(data =>
      {
        this.publicacionesDes = data;
        console.log(data);
        this.mensajeToast();
      },
      err => {
        console.log("Oops!");
      }
    );

  }*/

  limpiarFiltros() {
    //console.log("nombre_publicacion es: " + this.nombreF);
    //console.log("region es: " + document.getElementById("regionF").innerText);
    //console.log("comuna es: " + document.getElementById("comunaF").innerText);
    //console.log("tipo publicacion es: " + document.getElementById("tipoPF").innerText);
    //console.log("tipo turismo es: " + document.getElementById("tipoTF").innerText);
    this.regionF = [];
    this.comunaF = [];
    this.tipoPF = [];
    this.tipoTF = [];    
  }

}


