import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { CrearPublicacionPage } from './crear-publicacion';

@NgModule({
  declarations: [
    CrearPublicacionPage,
  ],
  imports: [
    IonicPageModule.forChild(CrearPublicacionPage),
  ],
})
export class CrearPublicacionPageModule {}
