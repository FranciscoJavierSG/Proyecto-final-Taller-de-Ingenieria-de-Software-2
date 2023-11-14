import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { CrearReviewPage } from './crear-review';

@NgModule({
  declarations: [
    CrearReviewPage,
  ],
  imports: [
    IonicPageModule.forChild(CrearReviewPage),
  ],
})
export class CrearReviewPageModule {}
