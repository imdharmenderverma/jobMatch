<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\AppUserRepositoryInterface;
use App\Interfaces\AppUserTempRepositoryInterface;
use App\Interfaces\BusinessRepositoryInterface;
use App\Interfaces\CmsRepositoryInterface;
use App\Interfaces\FaqRepositoryInterface;
use App\Interfaces\HelpRepositoryInterface;
use App\Interfaces\InboxRepositoryInterface;
use App\Interfaces\IndustryRepositoryInterface;
use App\Interfaces\JobApplyRepositoryInterface;
use App\Interfaces\JobRepositoryInterface;
use App\Interfaces\RecruiterRepositoryInterface;
use App\Interfaces\SkillRepositoryInterface;
use App\Interfaces\StatementRepositoryInterface;
use App\Interfaces\StatementSkillRepositoryInterface;
use App\Interfaces\UserCertificateRepositoryInterface;
use App\Interfaces\UserEducationRepositoryInterface;
use App\Interfaces\UserPortfolioRepositoryInterface;
use App\Interfaces\UserSkillRepositoryInterface;
use App\Interfaces\UserStatementRepositoryInterface;
use App\Repositories\AppUserRepository;
use App\Repositories\AppUserTempRepository;
use App\Repositories\BusinessRepository;
use App\Repositories\CmsRepository;
use App\Repositories\FaqRepository;
use App\Repositories\HelpRepository;
use App\Repositories\InboxRepository;
use App\Repositories\IndustryRepository;
use App\Repositories\JobApplyRepository;
use App\Repositories\JobRepository;
use App\Repositories\RecruiterRepository;
use App\Repositories\SkillRepository;
use App\Repositories\StatementRepository;
use App\Repositories\StatementSkillRepository;
use App\Repositories\UserCertificateRepository;
use App\Repositories\UserEducationRepository;
use App\Repositories\UserPortfolioRepository;
use App\Repositories\UserSkillRepository;
use App\Repositories\UserStatementRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BusinessRepositoryInterface::class, BusinessRepository::class);
        $this->app->bind(RecruiterRepositoryInterface::class, RecruiterRepository::class);
        $this->app->bind(SkillRepositoryInterface::class, SkillRepository::class);
        $this->app->bind(JobRepositoryInterface::class, JobRepository::class);
        $this->app->bind(AppUserRepositoryInterface::class, AppUserRepository::class);
        $this->app->bind(UserSkillRepositoryInterface::class, UserSkillRepository::class);
        $this->app->bind(AppUserTempRepositoryInterface::class, AppUserTempRepository::class);
        $this->app->bind(UserStatementRepositoryInterface::class, UserStatementRepository::class);
        $this->app->bind(StatementRepositoryInterface::class, StatementRepository::class);
        $this->app->bind(UserPortfolioRepositoryInterface::class, UserPortfolioRepository::class);
        $this->app->bind(UserEducationRepositoryInterface::class, UserEducationRepository::class);
        $this->app->bind(UserCertificateRepositoryInterface::class, UserCertificateRepository::class);
        $this->app->bind(JobApplyRepositoryInterface::class, JobApplyRepository::class);
        $this->app->bind(IndustryRepositoryInterface::class, IndustryRepository::class);
        $this->app->bind(CmsRepositoryInterface::class, CmsRepository::class);
        $this->app->bind(FaqRepositoryInterface::class, FaqRepository::class);
        $this->app->bind(HelpRepositoryInterface::class, HelpRepository::class);
        $this->app->bind(StatementSkillRepositoryInterface::class, StatementSkillRepository::class);
        $this->app->bind(InboxRepositoryInterface::class, InboxRepository::class);



    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
