<?php

namespace App\Http\Controllers;
use App\Models\User;
use Nette\Utils\Image;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class PdfController extends Controller
{
    public function index() 
    {
        $users=User::get();
         // Load the image
        $image = Image::make(public_path('public\storage\images\innobativeSkills.jpg'));

        // Add text to the image
        $image->text($users->getName(), 100, 100, function($font) {
            $font->file(public_path('public\storage\font\BRUSHSCI.TTF')); // Path to your font file
            $font->size(75);
            $font->color('#000000');
            $font->align('center');
            $font->valign('center');
        });

        // Save the modified image
        $imagePath = storage_path('storage\app\public\certificate/'.$users->getName().'.jpg');
        $image->save($imagePath);

        // Generate PDF from the modified image

    	$pdf = app('dompdf.wrapper'); // Create an instance of the PDF class
        $pdf->loadView('sample-with-image', compact('imagePath'));

        // Download or display the PDF
        return $pdf->stream('sample-with-image.pdf');
    }

}
