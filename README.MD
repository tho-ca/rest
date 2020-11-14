## Laravel Package to Generate a REST API CRUD

This package generates a laravel repository pattern template with a complete CRUD thats speeds up your codding.

### Install

```bash
composer require thoca/rest
```

### Usage

You can use the laravel artisan command passing the Model Name.

```bash
php artisan make: rest Post
```
<p align="left">
    <img alt="Demo on Vercel" src="https://i.imgur.com/e3YQKeM.png">
</p>

### Preview
<div>
    <h2>Model Created:</h2>
</div>

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'name',
    ];
}
```

<div>
    <h2>Resource Created</h2>
</div>

```php
<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,

        ];
    }
}
```

<div>
    <h2>Repository Created:</h2>
</div>

```php
<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\AbstractRepository;
use Illuminate\Support\Facades\DB;

class PostRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(new Post());
    }

    public function all($search, $per_page = null)
    {
        $query = app(Post::class)->newQuery();

        if ($search['term']) {
            $term = '%' . strtoupper(implode('%', explode(' ', $search['term']))) . '%';

            $query->where('name', 'like', $term);
        }

        if ($per_page) {
            $query->paginate($per_page);
        }

        return $query->orderBy('name')->get();
    }

    public function find($id)
    {
        return Post::find($id);
    }

    public function save($data, $id = null)
    {
        DB::beginTransaction();
        try {
            $model = ($id) ? $this->find($id) : new Post;

            $model->fill($data->all());

            $model->save();

            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage(), null, $e);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $model = $this->find($id);

            $model->delete();
            
            DB::commit();
            return $model;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage(), null, $e);
        }
    }
}
```
<div>
    <h2>Request Created:</h2>
</div>

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }

}
```

<div>
    <h2>Controller Created:</h2>
</div>

```php
<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        try {
            $values = new PostRepository();

            $per_page = $request->query('per_page', null);
            $search = ["term" => $request->query('term', null)];

            return PostResource::collection($values->all($search, $per_page));
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error.",
                "message_raw" => $e->getMessage()
            ], 500);
        }
    }

    public function store(PostRequest $request)
    {
        try {
            $model = (new PostRepository)->save($request);

            return response()->json(new PostResource($model), 201);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error.",
                "message_raw" => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $model = (new PostRepository)->find($id);

            return new PostResource($model);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error.",
                "message_raw" => $e->getMessage()
            ], 500);
        }
    }

    public function update(PostRequest $request, $id)
    {
        try {
            $model = (new PostRepository)->save($request, $id);

            return new PostResource($model);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error.",
                "message_raw" => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $model = (new PostRepository)->delete($id);

            return new PostResource($model);
        } catch (\Exception $e) {
            return response()->json([
                "message" => "Error.",
                "message_raw" => $e->getMessage()
            ], 500);
        }
    }
}
```


### License

The Laravel 8 Packages's Readme File(Docs) Viewer is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
