<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      include '../../modelo/conexion.php'; //llamamos a la conexion BD

      $consulta_info = $conexion->query(" select *from empresa ");//traemos datos de la empresa desde BD
      $dato_info = $consulta_info->fetch_object();
      $this->Image('logo.png', 165, 1, 45); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode($dato_info->nombre), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* UBICACION */
      $this->Cell(145);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Ubicación : " . $dato_info->ubicacion), 0, 0, '', 0);
      $this->Ln(5);

      /* TELEFONO */
      $this->Cell(145);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Teléfono : " . $dato_info->telefono), 0, 0, '', 0);
      $this->Ln(5);

      /* RFC */
      $this->Cell(145);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(85, 10, utf8_decode("Rfc : " . $dato_info->ruc), 0, 0, '', 0);
      $this->Ln(15);


      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(242, 66, 27);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'B', 19);
      $this->Cell(100, 10, utf8_decode("REPORTE DE EMPLEADOS "), 0, 1, 'C', 0);
      $this->Ln(10);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(242, 66, 27); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(15, 10, utf8_decode('N°'), 1, 0, 'C', 1);
      $this->Cell(90, 10, utf8_decode('EMPLEADO'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('DNI'), 1, 0, 'C', 1);
      $this->Cell(55, 10, utf8_decode('CARGO'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

include '../../modelo/conexion.php'; //llamamos a la conexion BD
//require '../../funciones/CortarCadena.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */
//$consulta_info = $conexion->query(" select *from hotel ");
//$dato_info = $consulta_info->fetch_object();

$pdf = new PDF();
$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 10);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

$consulta_reporte_empleado = $conexion->query(" select empleado.nombre,empleado.apellido,empleado.dni,cargo.nombre as 'nomCargo' from empleado
inner join cargo ON cargo.id_cargo=empleado.cargo ");

while ($datos_reporte = $consulta_reporte_empleado->fetch_object()) {   
   
   $i = $i + 1;
/* TABLA */
$pdf->Cell(15, 10, utf8_decode($i), 1, 0, 'C', 0);
$pdf->Cell(90, 10, utf8_decode($datos_reporte->nombre ." ".$datos_reporte->apellido), 1, 0, 'C', 0);
$pdf->Cell(30, 10, utf8_decode($datos_reporte->dni), 1, 0, 'C', 0);
$pdf->Cell(55, 10, utf8_decode($datos_reporte->nomCargo), 1, 1, 'C', 0);

   }



$pdf->Output('reporteEmpleados.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
