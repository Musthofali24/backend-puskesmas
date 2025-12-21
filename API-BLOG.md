# Blog API Documentation

## Base URL

```
http://your-domain.com/api
```

## Endpoints

### 1. Get All Blogs (dengan pagination)

**GET** `/blogs`

#### Query Parameters

| Parameter | Type    | Default | Description             |
| --------- | ------- | ------- | ----------------------- |
| page      | integer | 1       | Halaman pagination      |
| per_page  | integer | 12      | Jumlah item per halaman |
| category  | string  | -       | Filter by category      |
| search    | string  | -       | Search by title/content |

#### Response Example

```json
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "title": "10 Tips Menjaga Kesehatan di Musim Hujan",
                "slug": "10-tips-menjaga-kesehatan-di-musim-hujan",
                "category": "artikel-kesehatan",
                "excerpt": "Musim hujan sering membawa berbagai penyakit...",
                "featured_image": "/storage/blog-images/image.jpg",
                "author": "Dr. Ahmad Setiawan",
                "read_time": 5,
                "published_at": "2025-12-19T10:30:00.000000Z",
                "views_count": 125
            }
        ],
        "per_page": 12,
        "total": 50,
        "last_page": 5
    }
}
```

#### Usage Examples

```javascript
// Fetch all blogs
fetch("/api/blogs")
    .then((res) => res.json())
    .then((data) => console.log(data));

// Fetch with pagination
fetch("/api/blogs?page=2&per_page=10")
    .then((res) => res.json())
    .then((data) => console.log(data));

// Filter by category
fetch("/api/blogs?category=berita-kesehatan")
    .then((res) => res.json())
    .then((data) => console.log(data));

// Search blogs
fetch("/api/blogs?search=diabetes")
    .then((res) => res.json())
    .then((data) => console.log(data));
```

---

### 2. Get Latest Blogs

**GET** `/blogs/latest`

#### Query Parameters

| Parameter | Type    | Default | Description                  |
| --------- | ------- | ------- | ---------------------------- |
| limit     | integer | 3       | Jumlah blog yang ditampilkan |

#### Response Example

```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "10 Tips Menjaga Kesehatan di Musim Hujan",
            "slug": "10-tips-menjaga-kesehatan-di-musim-hujan",
            "category": "artikel-kesehatan",
            "excerpt": "Musim hujan sering membawa berbagai penyakit...",
            "featured_image": "/storage/blog-images/image.jpg",
            "author": "Dr. Ahmad Setiawan",
            "read_time": 5,
            "published_at": "2025-12-19T10:30:00.000000Z",
            "views_count": 125
        }
    ]
}
```

#### Usage Example

```javascript
// Get 3 latest blogs
fetch("/api/blogs/latest")
    .then((res) => res.json())
    .then((data) => console.log(data));

// Get 5 latest blogs
fetch("/api/blogs/latest?limit=5")
    .then((res) => res.json())
    .then((data) => console.log(data));
```

---

### 3. Get Popular Blogs

**GET** `/blogs/popular`

#### Query Parameters

| Parameter | Type    | Default | Description                  |
| --------- | ------- | ------- | ---------------------------- |
| limit     | integer | 5       | Jumlah blog yang ditampilkan |

#### Response Example

```json
{
    "success": true,
    "data": [
        {
            "id": 3,
            "title": "Pentingnya Deteksi Dini Diabetes",
            "slug": "pentingnya-deteksi-dini-diabetes",
            "category": "promosi-kesehatan",
            "featured_image": "/storage/blog-images/image.jpg",
            "views_count": 203,
            "published_at": "2025-12-14T08:00:00.000000Z"
        }
    ]
}
```

#### Usage Example

```javascript
// Get 5 most popular blogs
fetch("/api/blogs/popular")
    .then((res) => res.json())
    .then((data) => console.log(data));

// Get top 10
fetch("/api/blogs/popular?limit=10")
    .then((res) => res.json())
    .then((data) => console.log(data));
```

---

### 4. Get Blogs by Category

**GET** `/blogs/category/{category}`

#### URL Parameters

| Parameter | Type   | Required | Values                                                                     |
| --------- | ------ | -------- | -------------------------------------------------------------------------- |
| category  | string | Yes      | berita-kesehatan, promosi-kesehatan, artikel-kesehatan, kegiatan-puskesmas |

#### Query Parameters

| Parameter | Type    | Default | Description             |
| --------- | ------- | ------- | ----------------------- |
| page      | integer | 1       | Halaman pagination      |
| per_page  | integer | 12      | Jumlah item per halaman |

#### Response Example

```json
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 2,
                "title": "Program Imunisasi Gratis untuk Balita",
                "slug": "program-imunisasi-gratis-untuk-balita",
                "category": "berita-kesehatan",
                "excerpt": "Puskesmas kami mengadakan program imunisasi gratis...",
                "featured_image": "/storage/blog-images/image.jpg",
                "author": "Admin Puskesmas",
                "read_time": 3,
                "published_at": "2025-12-16T09:00:00.000000Z",
                "views_count": 87
            }
        ],
        "per_page": 12,
        "total": 15,
        "last_page": 2
    }
}
```

#### Usage Example

```javascript
// Get all "Berita Kesehatan"
fetch("/api/blogs/category/berita-kesehatan")
    .then((res) => res.json())
    .then((data) => console.log(data));

// Get "Artikel Kesehatan" page 2
fetch("/api/blogs/category/artikel-kesehatan?page=2")
    .then((res) => res.json())
    .then((data) => console.log(data));
```

---

### 5. Get Single Blog by Slug

**GET** `/blogs/{slug}`

#### URL Parameters

| Parameter | Type   | Required | Description                 |
| --------- | ------ | -------- | --------------------------- |
| slug      | string | Yes      | URL-friendly slug dari blog |

#### Response Example

```json
{
    "success": true,
    "data": {
        "id": 1,
        "title": "10 Tips Menjaga Kesehatan di Musim Hujan",
        "slug": "10-tips-menjaga-kesehatan-di-musim-hujan",
        "category": "artikel-kesehatan",
        "excerpt": "Musim hujan sering membawa berbagai penyakit...",
        "content": "<h2>Pentingnya Menjaga Kesehatan di Musim Hujan</h2><p>...</p>",
        "featured_image": "/storage/blog-images/image.jpg",
        "author": "Dr. Ahmad Setiawan",
        "read_time": 5,
        "is_published": true,
        "published_at": "2025-12-19T10:30:00.000000Z",
        "views_count": 126,
        "meta_tags": null,
        "created_at": "2025-12-19T10:00:00.000000Z",
        "updated_at": "2025-12-21T15:30:00.000000Z"
    }
}
```

**Note:** Views count akan otomatis bertambah 1 setiap kali endpoint ini dipanggil.

#### Usage Example

```javascript
// Get blog detail
fetch("/api/blogs/10-tips-menjaga-kesehatan-di-musim-hujan")
    .then((res) => res.json())
    .then((data) => console.log(data));
```

---

### 6. Get Related Blogs

**GET** `/blogs/{slug}/related`

#### URL Parameters

| Parameter | Type   | Required | Description                 |
| --------- | ------ | -------- | --------------------------- |
| slug      | string | Yes      | URL-friendly slug dari blog |

#### Query Parameters

| Parameter | Type    | Default | Description         |
| --------- | ------- | ------- | ------------------- |
| limit     | integer | 3       | Jumlah blog terkait |

#### Response Example

```json
{
    "success": true,
    "data": [
        {
            "id": 5,
            "title": "Mengenal Lebih Dekat Gizi Seimbang",
            "slug": "mengenal-lebih-dekat-gizi-seimbang",
            "category": "artikel-kesehatan",
            "excerpt": "Gizi seimbang adalah kunci hidup sehat...",
            "featured_image": "/storage/blog-images/image.jpg",
            "author": "Ahli Gizi Puskesmas",
            "read_time": 6,
            "published_at": "2025-12-11T07:00:00.000000Z"
        }
    ]
}
```

#### Usage Example

```javascript
// Get related blogs
fetch("/api/blogs/10-tips-menjaga-kesehatan-di-musim-hujan/related")
    .then((res) => res.json())
    .then((data) => console.log(data));

// Get 5 related blogs
fetch("/api/blogs/10-tips-menjaga-kesehatan-di-musim-hujan/related?limit=5")
    .then((res) => res.json())
    .then((data) => console.log(data));
```

---

## React/Next.js Integration Example

### Fetch All Blogs with SWR

```javascript
import useSWR from "swr";

const fetcher = (url) => fetch(url).then((res) => res.json());

function BlogList() {
    const { data, error, isLoading } = useSWR("/api/blogs", fetcher);

    if (isLoading) return <div>Loading...</div>;
    if (error) return <div>Failed to load</div>;

    return (
        <div>
            {data.data.data.map((blog) => (
                <article key={blog.id}>
                    <h2>{blog.title}</h2>
                    <p>{blog.excerpt}</p>
                </article>
            ))}
        </div>
    );
}
```

### Fetch Single Blog (Server Component - Next.js)

```javascript
async function getBlog(slug) {
    const res = await fetch(`http://localhost:8000/api/blogs/${slug}`);
    if (!res.ok) throw new Error("Failed to fetch blog");
    return res.json();
}

export default async function BlogDetail({ params }) {
    const { data: blog } = await getBlog(params.slug);

    return (
        <article>
            <h1>{blog.title}</h1>
            <div dangerouslySetInnerHTML={{ __html: blog.content }} />
        </article>
    );
}
```

### Filter by Category

```javascript
import { useState, useEffect } from "react";

function BlogsByCategory({ category }) {
    const [blogs, setBlogs] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetch(`/api/blogs/category/${category}`)
            .then((res) => res.json())
            .then((data) => {
                setBlogs(data.data.data);
                setLoading(false);
            });
    }, [category]);

    if (loading) return <div>Loading...</div>;

    return (
        <div>
            <h2>{category}</h2>
            {blogs.map((blog) => (
                <div key={blog.id}>{blog.title}</div>
            ))}
        </div>
    );
}
```

---

## Error Responses

### 404 Not Found

```json
{
    "message": "No query results for model [App\\Models\\Blog]."
}
```

### 422 Validation Error

```json
{
    "message": "The given data was invalid.",
    "errors": {
        "category": ["The selected category is invalid."]
    }
}
```

---

## CORS Configuration

Jika frontend di domain berbeda, tambahkan CORS di Laravel:

```php
// config/cors.php
return [
    'paths' => ['api/*'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:3000'], // Your frontend URL
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
```

---

## Rate Limiting

Default Laravel API rate limit: **60 requests per minute**

Jika perlu custom rate limit, edit `bootstrap/app.php`:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->api(prepend: [
        \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    ]);

    $middleware->throttleApi('100,1'); // 100 requests per minute
})
```

---

## Testing API

### Using cURL

```bash
# Get all blogs
curl http://localhost:8000/api/blogs

# Get specific blog
curl http://localhost:8000/api/blogs/10-tips-menjaga-kesehatan-di-musim-hujan

# Get by category
curl http://localhost:8000/api/blogs/category/berita-kesehatan

# Search
curl "http://localhost:8000/api/blogs?search=diabetes"
```

### Using Postman

1. Import collection dengan endpoints di atas
2. Set base URL: `http://localhost:8000`
3. Test semua endpoints

---

## Tips & Best Practices

1. **Caching**: Implementasi cache untuk improve performance

```php
$blogs = Cache::remember('blogs.latest', 3600, function () {
    return Blog::published()->latest()->take(3)->get();
});
```

2. **Eager Loading**: Hindari N+1 query problem

```php
$blogs = Blog::with('author')->published()->get();
```

3. **API Versioning**: Gunakan prefix untuk versioning

```php
Route::prefix('v1')->group(function () {
    Route::get('/blogs', [BlogController::class, 'index']);
});
```

4. **Error Handling**: Gunakan try-catch untuk handle errors

```php
try {
    $blog = Blog::findOrFail($id);
} catch (ModelNotFoundException $e) {
    return response()->json(['error' => 'Blog not found'], 404);
}
```

---

**Created by:** GitHub Copilot  
**Date:** 21 December 2025  
**Version:** 1.0.0
