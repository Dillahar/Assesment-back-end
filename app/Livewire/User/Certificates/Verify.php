<?php

namespace App\Livewire\User\Certificates;

use Livewire\Component;
use App\Models\CertificateReceive;
use Livewire\Attributes\Layout;

#[Layout('layouts.landing')]
class Verify extends Component
{
    public $certificate;

    public function mount($number)
    {
        $this->certificate = CertificateReceive::where('number', $number)->firstOrFail();
    }
    public function render()
    {
        return view('livewire.user.certificates.verify', [
            'linkedin_share' => 'https://www.linkedin.com/profile/add?startTask=CERTIFICATION_NAME&name='.$this->certificate->course->title.'&organizationId=76249359&issueYear='.$this->certificate->created_at->format('Y').'&issueMonth='.$this->certificate->created_at->format('m').'&expirationYear='.$this->certificate->valid_until->format('Y').'&expirationMonth='.$this->certificate->created_at->format('m').'&certId='.$this->certificate->number.'&certUrl='.route('certificate.verify', $this->certificate->number)
        ]);
    }
}
