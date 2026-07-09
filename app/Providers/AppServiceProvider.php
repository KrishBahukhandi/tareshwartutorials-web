<?php

namespace App\Providers;

use App\Models\Enrollment;
use App\Policies\EnrollmentPolicy;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Enrollment::class, EnrollmentPolicy::class);

        $this->registerCaseInsensitiveLikeMacros();
    }

    /**
     * MySQL's default collation makes LIKE case-insensitive; PostgreSQL's
     * LIKE is case-sensitive and needs ILIKE for the same behaviour. These
     * macros pick the right operator per connection so query code doesn't
     * have to care which database it's running against.
     */
    private function registerCaseInsensitiveLikeMacros(): void
    {
        $whereLike = function (string $column, string $value, string $boolean = 'and') {
            /** @var QueryBuilder|EloquentBuilder $this */
            $operator = $this->getConnection()->getDriverName() === 'pgsql' ? 'ilike' : 'like';

            return $this->where($column, $operator, $value, $boolean);
        };

        $orWhereLike = function (string $column, string $value) use ($whereLike) {
            /** @var QueryBuilder|EloquentBuilder $this */
            return $whereLike->call($this, $column, $value, 'or');
        };

        QueryBuilder::macro('whereLike', $whereLike);
        QueryBuilder::macro('orWhereLike', $orWhereLike);
        EloquentBuilder::macro('whereLike', $whereLike);
        EloquentBuilder::macro('orWhereLike', $orWhereLike);
    }
}
