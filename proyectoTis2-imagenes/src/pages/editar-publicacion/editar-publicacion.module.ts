import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { EditarPublicacionPage } from './editar-publicacion';

@NgModule({
  declarations: [
    EditarPublicacionPage,
  ],
  imports: [
    IonicPageModule.forChild(EditarPublicacionPage),
  ],
})
export class EditarPublicacionPageModule {}
