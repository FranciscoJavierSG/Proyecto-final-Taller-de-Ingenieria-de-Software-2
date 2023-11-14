import { NgModule } from '@angular/core';
import { IonicPageModule } from 'ionic-angular';
import { AgregarEtiquetaPage } from './agregar-etiqueta';

@NgModule({
  declarations: [
    AgregarEtiquetaPage,
  ],
  imports: [
    IonicPageModule.forChild(AgregarEtiquetaPage),
  ],
})
export class AgregarEtiquetaPageModule {}
