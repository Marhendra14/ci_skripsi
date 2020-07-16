<?php    
    // var_dump($data);
    // $ukuran = sizeof($data);
    // $modulus = $ukuran%3;
    // var_dump($modulus); 
    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetTitle('Preview');
            $pdf->SetHeaderMargin(30);
            $pdf->SetTopMargin(20);
            $pdf->SetAutoPageBreak(true);
            $pdf->SetAuthor('Author');
            $pdf->SetDisplayMode('real', 'default');
            $pdf->AddPage();
            $i=0;
            $size = sizeof($data);
            $html='<h3>Hasil Cetak</h3><table align="center" border="2"><tr>';
            for($i=0; $i <sizeof($data); $i++)
            {
                $modulus = ($i+1)%3;

                $html .= '<th> No Batch : '.$data[$i]->no_batch.'<br> No Kantong : '.$data[$i]->no_kantong.'<br> <img src="'.base_url('assets/img/').$data[$i]->qrcode.'" height="100"/></th>';

                if($modulus == 0){
                    $html .= '</tr><tr>';
                }
            }
            // foreach ($data as $row) 
            // { 
            //     $html.= '<hr>No batch : '.$row->no_batch.'<br>'.
            //             'No kantong : '.$row->no_kantong.
            //             '<br><img src="'.base_url('assets/img/').$row->qrcode.'" height="100"/><br><hr>';
            // }
            // $coba = $data[0]['no_batch'];
            // $html.= 'Ukuran : '.$size.$coba;

            $html.='</tr></table>';

            // var_dump($html);

            $pdf->writeHTML($html, true, false, true, false, '');
            ob_end_clean();
            $pdf->Output('Cetak.pdf', 'I');
?>