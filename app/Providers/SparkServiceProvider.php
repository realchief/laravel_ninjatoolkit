<?php

namespace App\Providers;

use Laravel\Spark\Spark;
use Laravel\Spark\Providers\AppServiceProvider as ServiceProvider;

class SparkServiceProvider extends ServiceProvider
{
    /**
     * Your application and company details.
     *
     * @var array
     */
    protected $details = [
        'vendor' => 'NinjaToolkit',
        'product' => 'NinjaToolkit',
        'street' => 'PO Box 2095',
        'location' => 'Hawthorn, VIC 3122',
        'phone' => '0400 142 468',
    ];

    /**
     * The address where customer support e-mails should be sent.
     *
     * @var string
     */
    protected $sendSupportEmailsTo = null;

    /**
     * All of the application developer e-mail addresses.
     *
     * @var array
     */
    protected $developers = [
        //
    ];

    /**
     * Indicates if the application will expose an API.
     *
     * @var bool
     */
    protected $usesApi = true;

    /**
     * Finish configuring Spark for the application.
     *
     * @return void
     */
    public function booted()
    {
        Spark::useStripe()->noCardUpFront();

        Spark::freePlan('Free', 'plan_E0YGBujlhtEXl7')
            ->features([
                '500 Monthly Unique Visitors', 'NinjaToolkit branding'
            ]);

        Spark::plan('Pro', 'plan_E0YGWGNnAI1GXF')
            ->price(19)
            ->features([
                '5,000 Unique Monthly Visitors', 'Disable NinjaToolkit branding'
            ]);

    }
}
