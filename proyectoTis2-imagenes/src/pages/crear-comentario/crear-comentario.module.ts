import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { CrearComentarioPage } from './crear-comentario';

@NgModule({
  declarations: [
    CrearComentarioPage,
  ],
  imports: [
    IonicPageModule.forChild(CrearComentarioPage),
  ],
})
export class CrearComentarioPageModule {}
