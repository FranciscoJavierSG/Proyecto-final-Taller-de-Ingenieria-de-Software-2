import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { Http } from '@angular/http';
import 'rxjs/add/operator/map';
import { Observable } from 'rxjs/Observable';
import { ToastController } from 'ionic-angular';

/**
 * Generated class for the EditarPublicacionPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-editar-publicacion',
  templateUrl: 'editar-publicacion.html',
})
export class EditarPublicacionPage {

  id_publicacion = this.navParams.get('valor');
  publicacion : any;
  comunas: any;
  regiones: any;
  publicacionesDes:any;
 
  
  data: Observable<any>;
  nombre: any;
  descripcion: any;
  precio: any;
  ubicacion: any;
  telefono: any;
  correo: any;
  rrss: any;
  likes: any;
  tipo_publicacion: any;
  tipo_turismo: any;
  estado: any; //"pendiente" o "aprobado"
  //moderador: any;
  region: any;
  comuna: any;
  regionS: any;
  

  constructor(public navCtrl: NavController, public navParams: NavParams, public http: Http, private toastCtrl:ToastController) {
   
    //http://localhost/apiRest/public/publicacion_detallada/
    //https://edein.cl/equipo2/apiRest/public/publicacion_detallada/
    this.http.get('https://edein.cl/equipo2/apiRest/public/publicacion_detallada/'+this.id_publicacion)
    .map(response => response.json())
    .subscribe(data =>
      {
        this.publicacion = data;
        //this.agregarVisita();

        console.log(data);
      },
      err => {
        console.log("Oops!");
      }
    );
    this.http.get('https://apis.digital.gob.cl/dpa/regiones')
    .map(response => response.json())
    .subscribe(data3 => {
      this.regiones = data3;
      console.log(data3);
    },
      err => {
        console.log("Oops!");
      }
    );
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad EditarPublicacionPage');
  }

  onOptionsSelected(value: string) {
    console.log("Region seleccionada tiene codigo " + value);

    this.http.get('https://apis.digital.gob.cl/dpa/regiones/' + value + '/comunas')
      .map(response => response.json())
      .subscribe(data2 => {
        this.comunas = data2;
        console.log(data2);
      },
        err => {
          console.log("Oops!");
        }
      );
  }
  //voy a dejarlo aqui
  irEditarEtiqueta(){

  }

  editarPublicacion(){
    //http://localhost/apiRest/public/publicacion/editar
    //https://edein.cl/equipo2/apiRest/public/publicacion/editar
    var url = 'https://edein.cl/equipo2/apiRest/public/publicacion/editar';
    let postData = new FormData();

    console.log("El nombre_publicacion es: " + this.nombre);
    console.log("La descripcion es: " + this.descripcion);
    console.log("El precio es: " + this.precio);
    console.log("La ubicacion es: " + this.ubicacion);
    console.log("El telefono es: " + this.telefono);
    console.log("El email es: " + this.correo);
    console.log("Las redes_sociales son: " + this.rrss);
    //console.log("Los likes son: " + this.likes);
    console.log("El tipo_publicacion es: " + this.tipo_publicacion);
    console.log("El tipo_turismo es: " + this.tipo_turismo);
    //console.log("El id_moderador es: " + this.moderador);
    console.log("El id de la region es: " + this.region + ". Y el nombre es: " + document.getElementById("regionID").innerText);
    console.log("El id de la comuna es: " + this.comuna + ". Y el nombre es: " + document.getElementById("comunaID").innerText);
    
    
    
    postData.append('id_publicacion',this.id_publicacion);
    postData.append('nombre_publicacion', this.nombre);
    postData.append('descripcion_publicacion', this.descripcion);
    postData.append('valor_publicacion', this.precio);
    postData.append('direccion', this.ubicacion);
    postData.append('telefono_contacto', this.telefono);
    postData.append('email_contacto', this.correo);
    postData.append('redes_sociales', this.rrss);
    postData.append('tipo_publicacion', this.tipo_publicacion); //'producto','servicio','infraestructura'
    postData.append('tipo_turismo', this.tipo_turismo); //'negocios','urbano','natural','gastronomico','aventura','ecologico','cultural','lujo','diversion','religioso','espacial'
    //postData.append('estado', 'pendiente');
    //postData.append('id_moderador', '1');
    postData.append("region_publicacion", document.getElementById("regionID").innerText);
    postData.append("comuna_publicacion", document.getElementById("comunaID").innerText);
    

    this.http.post(url,postData)
    .map(response => response.json())
    .subscribe(data => {
      console.log(data);
      this.mensajeToast('Publicación editada correctamente y en espera de aprobación.');
     // this.irAgregarEtiqueta(id);
    });
   
  }

  
  mensajeToast(msg) {
    const toast = this.toastCtrl.create({
      message: msg,
      duration: 3000
    });
    toast.present();
  }
}
