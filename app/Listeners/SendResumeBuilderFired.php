<?php

namespace App\Listeners;

use App\Events\SendResumeBuilder;
use App\Http\Traits\ImageUploadTrait;
use App\Interfaces\AppUserRepositoryInterface;
use App\Models\ResumeBuilderSubscription;
use App\Models\ResumePdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use PDF;

class SendResumeBuilderFired
{
    use ImageUploadTrait;

    protected $appUserRepository = "";

    public function __construct(AppUserRepositoryInterface $appUserRepository)
    {
        $this->appUserRepository = $appUserRepository;
    }
    
      public function handle(SendResumeBuilder $event)
    {
        $user = $event->user->user_id;
        $resumeDataId = $event->user->id;
        $resume_format_id = $event->resume_format_id;

        $userData = $this->appUserRepository->getData($user);

        if ($userData instanceof ResumeBuilderSubscription) {
            $userData = $userData->toArray();
        }

        $pdfLodview = ResumePdf::where('pdf_id', $resume_format_id)->first();

        if ($pdfLodview) {
            $pdfName = "pdf." . $pdfLodview->name;
            if ($pdfName) {
                $pdfPath = "resume_subscriptions/" .auth()->user()->id.'/'. time() .rand(1000,9999). ".pdf";

                $pdf = PDF::loadView($pdfName, ['userData' => $userData]);
                $pdfData =  Storage::put("public/".$pdfPath, $pdf->output());

                $pdf->save(storage_path($pdfData));
                $getResumeSubscriptionData = ResumeBuilderSubscription::find($resumeDataId);
                $getResumeSubscriptionData->resume_pdf_url = $pdfPath;
                $getResumeSubscriptionData->save();

                $getResumeSubscriptionData->update(['resume_pdf_genreted' =>true]);
            }
        }
    }
}
