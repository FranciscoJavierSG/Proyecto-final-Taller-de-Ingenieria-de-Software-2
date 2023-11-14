import { Component } from '@angular/core';
import { AlertController, IonicPage, NavController, NavParams, ToastController } from 'ionic-angular';
import { Http } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import { LoginPage } from '../login/login';
import { HomePage } from '../home/home';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
/**
 * Generated class for the CrearReviewPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-crear-review',
  templateUrl: 'crear-review.html',
})
export class CrearReviewPage {

  datos:FormGroup;

  publicacion: any;
  review: any;
  id_publicacion = this.navParams.get('valor');
  data_pub: Observable<any>;
  data_rev: Observable<any>;
  usuario: any;
  calificacion: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public http: Http, public toastCtrl: ToastController, public formBuilder: FormBuilder, public alertController: AlertController) {

    //http://localhost/apiRest/public/publicacion/
    //https://edein.cl/equipo2/apiRest/public/publicacion/
    this.http.get('https://edein.cl/equipo2/apiRest/public/publicacion/' + this.id_publicacion)
      .map(response => response.json())
      .subscribe(data_pub => {
        this.publicacion = data_pub;

        console.log(data_pub);
      },
        err => {
          console.log("Oops!");
        }
      );

    //localStorage.clear(); //pa probar cuando no se ha logeado
    if ('respuesta' in localStorage) {
      var token = JSON.parse(localStorage.getItem('respuesta'));
      console.log(token);

      if (token.hasOwnProperty('data')) {
        console.log("El id del usuario es: " + token.data.id_usuario);
        console.log("ENTRÓ AL IF.");
        console.log("Llevar a crearReview"); //DEJARLO PASAR NOMAS
        this.usuario = token.data.id_usuario;
      }
    } else {
      console.log("NO ENTRÓ AL IF. ENTRÓ AL ELSE");
      console.log("No estás logeado");
      this.mensajeToast('Debes iniciar sesión para poder hacer una reseña.')
      this.irLogeo();
    }

    //Validador comentario
    this.datos = formBuilder.group({
      review_usuario:  ['',[Validators.required, Validators.minLength(10), Validators.maxLength(4999)]],
      calificacion_usuario:  ['',[Validators.required]]
    });

  }

  ionViewDidLoad() {
    console.log('Ya cargó CrearReviewPage');
  }

  mensajeToast(msg) {
    const toast = this.toastCtrl.create({
      message: msg,
      duration: 3000
    });
    toast.present();
  }

  async crearReview() {

    if(this.datos.invalid){
      const alert = await this.alertController.create({
        title: 'Error en reseña',
        message: '-Verifique si seleccionó una calificación. <br/> -Verifique si su reseña es muy corta o contiene caracteres no permitidos.',
        buttons: ['Aceptar']

      });
        await alert.present();
        return;
    }

    //http://localhost/apiRest/public/review/new
    //https://edein.cl/equipo2/apiRest/public/review/new
    var url_review = 'https://edein.cl/equipo2/apiRest/public/review/new';

    let postData = new FormData();

    console.log("El id_publicacion es: " + this.id_publicacion);
    console.log("La reseña es: " + this.review);
    console.log("El id_usuario es: " + this.usuario);
    console.log("El estado es: " + "pendiente");
    console.log("La calificacion es: " + this.calificacion);

    postData.append('review', this.review);
    postData.append('id_publicacion', this.id_publicacion); 
    postData.append('id_usuario', this.usuario);
    postData.append('estado', "pendiente");
    postData.append('calificacion_review', this.calificacion);

    this.data_rev = this.http.post(url_review, postData);

    this.data_rev.subscribe(data_rev=>{
      this.mensajeToast('Reseña enviada correctamente y pendiente de aprobación.');
      console.log(data_rev);
      this.navCtrl.setRoot(HomePage);
    },
    err => {
      this.mensajeToast('Hubo un error, inténtalo más tarde.');
      console.log("OopsReview!");
    });

  }

  irLogeo() {
    this.navCtrl.setRoot(LoginPage);
  }
}
