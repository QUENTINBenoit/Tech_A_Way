<?php

namespace App\Service;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;


class PictureUploader
{
    private $slugger;
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function upload(Form $form, $fieldName)
    {
        /** @var UploadedFile $imageFile */
        // we recover the physical file
        $pictureFile = $form->get($fieldName)->getData();

        if ($pictureFile) {
            $originalFileName = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);

            $safeFilename = $this->slugger->slug($originalFileName);
            $newFileName = $safeFilename . '-' . uniqid() . '.' . $pictureFile->guessExtension();

            try {
                $pictureFile->move('uploads', $newFileName);

                return $newFileName;
            } catch (FileException $e) {
                dump($e);
            }
        }
        return null;
    }
}