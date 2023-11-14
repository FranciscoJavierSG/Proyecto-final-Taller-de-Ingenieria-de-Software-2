import { Component } from '@angular/core';
import { AlertController, IonicPage, NavController, NavParams } from 'ionic-angular';
import { RegistroPage } from '../registro/registro';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Observable } from 'rxjs';
import { Http } from '@angular/http';
import { HomePage } from '../home/home';
import { CuentaPage } from '../cuenta/cuenta';
import { ToastController } from 'ionic-angular';

/**
 * Generated class for the LoginPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-login',
  templateUrl: 'login.html',
})
export class LoginPage {

  data: Observable<any>;
  datos: FormGroup;
  id_usuario: any;
  nombre_usuario: any;
  contrasena: any;
  email_usuario: any;
  postData: any;
  token: any;
  oferente: any;
  moderador: any;

  constructor(public navCtrl: NavController, public navParams: NavParams, public formBuilder: FormBuilder, public alertController: AlertController, private http: Http, private toastCtrl: ToastController) {
    this.datos = formBuilder.group({
      id_usuario: ['', [Validators.required, Validators.maxLength(20), Validators.minLength(5)]],
      nombre_usuario: ['', [Validators.required, Validators.maxLength(50), Validators.minLength(5)]],
      email_usuario: ['', [Validators.compose([Validators.required, Validators.pattern('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$')]), Validators.maxLength(35), Validators.minLength(5)]],
      contrasena: ['', [Validators.required, Validators.maxLength(30), Validators.minLength(5)]],
    });
    if ('respuesta' in localStorage) {
      this.irCuenta();
    }
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad LoginPage');
  }

  irRegistro() {
    this.navCtrl.push(RegistroPage);
  }

  irHome() {
    this.navCtrl.setRoot(HomePage);
  }
  irCuenta() {
    this.navCtrl.setRoot(CuentaPage);
  }


  async login() {

    var f = this.datos.value;

    //http://localhost/apiRest/public/login
    //https://edein.cl/equipo2/apiRest/public/login
    var url = 'https://edein.cl/equipo2/apiRest/public/login';
    console.log(f);

    //var usuario = JSON.parse(localStorage.getItem('usuario'));
    //Comenté eso para que no saliera una advertencia de que "nunca se usa"

    var token;
    //this.oferente();

    //Check usuario normal
    /*if (usuario.id_usuario == f.id_usuario && usuario.contrasena == f.contrasena) {
      this.irHome();
    } else {
    */

    //let body = JSON.stringify(postData);

    var respuesta;
    this.http.post(url, f)
      .map(Response => Response.json())
      .subscribe(data => {
        this.token = data;
        respuesta = this.token;
        if (respuesta.hasOwnProperty('error')) {
          if (respuesta.error.text == "Bad request wrong username and password") {
            this.mensajeToast('Datos incorrectos. Inténtalo nuevamente.');
            console.log(respuesta.error.text);
          }
        } else {
          localStorage.setItem('respuesta', JSON.stringify(respuesta));
          token = JSON.parse(localStorage.getItem('respuesta'));
          console.log(token);
          this.irHome();
          this.mensajeToast("Se ha iniciado sesión.");
        }

      });

    //console.log(token);

    /*const alert = await this.alertController.create({
      title: 'Datos incorrectos',
      message: 'Los datos que ingresaste no son correctos',
      buttons: ['Aceptar']

    });
    await alert.present();
    */

  }

  mensajeToast(msg: string) {
    let toast = this.toastCtrl.create({
      message: msg,
      duration: 3000,
    });
    toast.present();
  }
}
