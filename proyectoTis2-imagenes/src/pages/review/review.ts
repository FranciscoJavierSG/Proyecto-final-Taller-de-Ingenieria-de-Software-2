import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { Http } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import { CrearReviewPage } from '../crear-review/crear-review';

/**
 * Generated class for the ReviewPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
  selector: 'page-review',
  templateUrl: 'review.html',
})
export class ReviewPage {

  publicacion:any;
  review:any;
  id_publicacion = this.navParams.get('valor');
  data_pub:Observable<any>;
  data_rev:Observable<any>;

  constructor(public navCtrl: NavController, public navParams: NavParams, public http: Http) {
    

    //http://localhost/apiRest/public/publicacion/
    //https://edein.cl/equipo2/apiRest/public/publicacion/
    this.http.get('https://edein.cl/equipo2/apiRest/public/publicacion/' + this.id_publicacion)
    .map(response => response.json())
    .subscribe(data_pub =>
      {
        this.publicacion = data_pub;

        console.log(data_pub);
      },
      err => {
        console.log("Oops!");
      }
    );

    //http://localhost/apiRest/public/review/
    //https://edein.cl/equipo2/apiRest/public/review/
    this.http.get('https://edein.cl/equipo2/apiRest/public/review/' + this.id_publicacion)
    .map(response => response.json())
    .subscribe(data_rev =>
      {
        this.review = data_rev;

        console.log(data_rev);
      },
      err => {
        console.log("Oops!");
      }
    );
    
  }

  ionViewDidLoad() {
    console.log('Ya cargó ReviewPage');
  }

  irCrearReview(id_publicacion){
    this.navCtrl.push(CrearReviewPage, {valor: id_publicacion});
  }

}
