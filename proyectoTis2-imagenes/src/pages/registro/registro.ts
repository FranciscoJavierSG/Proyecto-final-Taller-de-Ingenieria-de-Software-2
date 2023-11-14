import { Component } from '@angular/core';
import { AlertController, IonicPage, NavController, NavParams } from 'ionic-angular';
import { Http } from '@angular/http';
import 'rxjs/add/operator/map';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Observable } from 'rxjs';
import { ToastController } from 'ionic-angular';

//Plugins
import { ImagePicker, ImagePickerOptions } from '@ionic-native/image-picker';
import { File } from '@ionic-native/file';

@IonicPage()
@Component({
  selector: 'page-registro',
  templateUrl: 'registro.html',
})

export class RegistroPage {

  //IMPORTANTE
  datos:FormGroup;
  data:Observable<any>;
  id_usuario:any;
  nombre_usuario:any;
  contrasena:any;
  email_usuario:any;
  foto_usuario:any;
  
  tipo:any;

  fotos:any=[];
  images:any=[];

  constructor(public navCtrl: NavController, public navParams: NavParams, private http: Http, public formBuilder: FormBuilder,private toastCtrl:ToastController, public alertController: AlertController, private imagePicker: ImagePicker, private file: File) {
      
    //File plugin
    //this.file.checkDir(this.file.dataDirectory, 'mydir').then(_ => console.log('Directory exists')).catch(err => console.log('Directory doesn\'t exist'));
    //ionic 3 angular 4
    
    this.datos = formBuilder.group({
      id_usuario:  ['',[Validators.required, Validators.maxLength(20), Validators.minLength(5)]],
      nombre_usuario: ['',[Validators.required, Validators.maxLength(50), Validators.minLength(5)]],
      email_usuario: ['',[Validators.compose([Validators.required,Validators.pattern('^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$')]), Validators.maxLength(35), Validators.minLength(5)]],
      contrasena: ['',[Validators.required, Validators.maxLength(30), Validators.minLength(5)]],
    });
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad RegistroPage');
  }
  irLogin(){
    this.navCtrl.pop();
  }

  async register(){
    let foto = this.fotos[0];
    var f = this.datos.value;
    
    if(this.datos.invalid){
      const alert = await this.alertController.create({
        title: 'Datos incorrectos.',
        message: this.fotos,

        buttons: ['Aceptar']

      });
        await alert.present();
        return;
    }

    console.log(this.id_usuario);
    console.log(this.nombre_usuario);
    console.log(this.contrasena);
    console.log(this.email_usuario);
    console.log(this.fotos);

    var usuario ={
      id_usuario: f.id_usuario,
      nombre_usuario: f.nombre_usuario,
      contrasena: f.contrasena,
      email_usuario: f.email_usuario,
      base64: foto
    }
    
    //this.presentToast(usuario.base64);
    localStorage.setItem('usuario', JSON.stringify(usuario));

    console.log(JSON.stringify(usuario));

    var url =  'https://edein.cl/equipo2/apiRest/public/signup';
    //var url2 = 'http://localhost/apiRest/public/signup';

    let postData = new FormData();

    postData.append('id_usuario',this.id_usuario);
    postData.append('nombre_usuario',this.nombre_usuario);
    postData.append('contrasena',this.contrasena);
    postData.append('email_usuario',this.email_usuario);
    postData.append('base64',usuario.base64);

    this.data = this.http.post(url,postData);

    this.data.subscribe((data) => {
      console.log(data);

      this.presentToast(usuario.base64);
      //this.presentToast(data);
      this.navCtrl.pop();

    }), err => {
      console.log("Oops!");
    }


  
  }

  presentToast(msg: string){
    let toast = this.toastCtrl.create({
      message: msg,
      duration: 2000,
    });
    toast.present();
  }

  abrirGaleria(){

      
      var options: ImagePickerOptions = {
                maximumImagesCount: 1,
                width: 200,
                height: 200
      }

      /*this.imagePicker.getPictures(options).then((results) => {
              this.fotos = results;
      }, (err) => { });*/
      this.imagePicker.getPictures(options).then((results) => {
        for (var i = 0; i < results.length; i++) {
            let filename = results[i].substring(results[i].lastIndexOf('/')+1);
            let path = results[i].substring(0,results[i].lastIndexOf('/')+1);
            this.file.readAsDataURL(path, filename).then((base64string)=>{
              this.fotos.push(base64string);
            })
        }
      }, (err) => { });

  }

  borrarFoto(index) {
    this.fotos.splice(index, 1);
  }

}