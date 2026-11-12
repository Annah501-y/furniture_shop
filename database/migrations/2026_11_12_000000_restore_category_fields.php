<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('categories', 'parent_id')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->foreignId('parent_id')
                    ->nullable()
                    ->after('id')
                    ->constrained('categories')
                    ->nullOnDelete();
            });
        }

        $addedName = ! Schema::hasColumn('categories', 'name');
        if ($addedName) {
            Schema::table('categories', function (Blueprint $table) {
                $table->string('name', 150)->nullable()->after('parent_id');
            });
        }

        $addedSlug = ! Schema::hasColumn('categories', 'slug');
        if ($addedSlug) {
            Schema::table('categories', function (Blueprint $table) {
                $table->string('slug', 150)->nullable()->unique()->after('name');
            });
        }

        if (! Schema::hasColumn('categories', 'image')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->string('image')->nullable()->after('slug');
            });
        }

        if (! Schema::hasColumn('categories', 'sort_order')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->unsignedInteger('sort_order')->default(0)->after('image');
            });
        }

        if (! Schema::hasColumn('categories', 'is_active')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->boolean('is_active')->default(true)->after('sort_order');
            });
        }

        if ($addedName || $addedSlug) {
            foreach (DB::table('categories')->select('id')->orderBy('id')->get() as $category) {
                $values = [];

                if ($addedName) {
                    $values['name'] = 'Category '.$category->id;
                }

                if ($addedSlug) {
                    $values['slug'] = 'category-'.$category->id;
                }

                DB::table('categories')->where('id', $category->id)->update($values);
            }

            Schema::table('categories', function (Blueprint $table) use ($addedName, $addedSlug) {
                if ($addedName) {
                    $table->string('name', 150)->nullable(false)->change();
                }

                if ($addedSlug) {
                    $table->string('slug', 150)->nullable(false)->change();
                }
            });
        }
    }

    public function down(): void
    {
        // Keep repaired fields in place: on aligned installations this migration is a no-op.
    }
};
