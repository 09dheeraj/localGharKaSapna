<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategories;
use App\Models\NewsArticles;
use App\Models\PostProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    public function manageAllProperties()
    {
        $title = "Manage All Posted Properties - Ghar Ka Sapna Admin";
        $properties = PostProperty::orderBy('created_at', 'desc')->get();

        return view('Admin.all_post_properties', compact('title', 'properties'));
    }

    public function managePropertyStatus(Request $request)
    {
        //print_r($request->all());
        $id = $request->input('propertyId');
        $status = $request->input('selectedValue');

        $findProperty = PostProperty::where('id', $id)->update(['status' => $status]);

        if ($findProperty) {
            return response()->json(['success' => 'Property status updated successfully', 'status' => $status]);
        } else {
            return response()->json(['error' => 'property not found'], 404);
        }
    }

    public function deleteProperty(Request $request)
    {
        $id = $request->input('propertyID');

        $property = PostProperty::find($id);

        if ($property) {
            $property->delete();
            return response()->json(['success' => true, 'message' => 'Property deleted successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Property not found']);
    }

    public function postPropertiesAdmin()
    {
        $sessionId = session()->get('id');
        $title = "All Posted Properties - Ghar Ka Sapna Admin";
        $properties = PostProperty::where('reg_id', $sessionId)->orderBy('created_at', 'desc')->get();
        return view('Admin.post_properties', compact('title', 'properties'));
    }

    public function newsArticles()
    {
        $title = 'Manage News and Articles - Ghar Ka Sapna Admin';
        $articles = NewsArticles::orderBy('created_at', 'desc')->get();
        return view('Admin.articles_news', compact('title', 'articles'));
    }

    public function singleArticle($id, $name)
    {
        $Id = base64_decode($id);
        $decodeName = base64_decode($name);

        $title = $decodeName . " Ghar Ka Sapna Admin";
        $article = NewsArticles::where('id', $Id)->first();
        $nextArticle = NewsArticles::where('created_at', '>', $article->created_at)->orderBy('created_at')->first();
        $previousArticle = NewsArticles::where('created_at', '<', $article->created_at)->orderBy('created_at', 'desc')->first();
        return view('Admin.single_article', compact('title', 'article', 'nextArticle', 'previousArticle'));
    }

    public function postNewsArticles()
    {

        $title = "Submit Your News & Articles - Ghar Ka Sapna Admin";
        $articleCat = ArticleCategories::all();
        return view('Admin.post_news_articles', compact('title', 'articleCat'));
    }


    public function editArticle($id, $name)
    {
        $Id = base64_decode($id);
        $decodeName = base64_decode($name);
        $title = $decodeName . " Ghar Ka Sapna Admin";
        $article = NewsArticles::where('id', $Id)->first();
        $articleCat = ArticleCategories::all();
        return view('Admin.edit_article', compact('title', 'article', 'articleCat'));
    }


    public function articleCategory(Request $request)
    {
        //  print_r($request->all());
        $category = $request->input('cat');

        $existingCategory = ArticleCategories::where('name', $category)->first();

        if ($existingCategory) {
            return response()->json(['exist' => 'Category already exists!']);
        }

        $article = ArticleCategories::create([
            'name' => $category
        ]);

        if ($article) {
            return response()->json(['success' => true, 'msg' => 'Category added successfully', 'category' => $article]);
        }
        return response()->json(['success' => false, 'msg' => 'Failed to add category']);;
    }


    public function insertArticles(Request $request)
    {
        $title = $request->input('title');
        $tickTitle = $request->input('tick_title');
        $metaTitle = $request->input('meta_title');
        $metaDescription = $request->input('meta_description');
        $metaKeywords = $request->input('meta_keywords');
        $excerpt = $request->input('excerpt');
        $shortDescription = $request->input('short_description');
        $content = $request->input('content');
        $category = $request->input('categories');

        $featuredImage = null;

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            if ($image->isValid()) {
                $originalExtension = $image->getClientOriginalExtension();
                $newExtension = '.webp';
                $words = Str::words($title, 5, '');
                $sanitizedTitleName = Str::slug($words);
                $uniqueName = $sanitizedTitleName . '_' . Str::random(4) . $newExtension;
                $imagePath = public_path('assets/articlesImages/' . $uniqueName);
                $image->move(public_path('assets/articlesImages/'), $uniqueName);
                $featuredImage = $uniqueName;
            }
        }

        $additionalImages = [];

        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                if ($image->isValid()) {
                    $originalExtension = $image->getClientOriginalExtension();
                    $newExtension = '.webp';
                    $words = Str::words($title, 5, '');
                    $additionalTitleName = Str::slug($words);
                    $randomString = Str::random(4);
                    $additionalName = $additionalTitleName . '_' . $randomString . $newExtension;
                    $additionalImages[] = $additionalName;
                    $imagePath = public_path('assets/articlesImages/' . $additionalName);
                    $image->move(public_path('assets/articlesImages/'), $additionalName);
                }
            }
        }

        $implodeAdditionalImages = implode(',', $additionalImages);

        $insertArticles = [
            'category' => $category,
            'title' => $title,
            'heading' => $tickTitle,
            'excerpt' => $excerpt,
            'meta_title' => $metaTitle,
            'meta_description' => $metaDescription,
            'meta_keywords' => $metaKeywords,
            'short_description' => $shortDescription,
            'content' => $content,
            'featured_image' => $featuredImage,
            'additional_images' => $implodeAdditionalImages,
            'status' => 'pending',
        ];

        $articles = NewsArticles::create($insertArticles);

        if ($articles) {
            return redirect()->back()->with('success', 'Article created successfully!');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to create article.']);
        }
    }


    public function updateArticle(Request $request)
    {
        $id = $request->input('article_id');
        $title = $request->input('title');
        $tickTitle = $request->input('tick_title');
        $metaTitle = $request->input('meta_title');
        $metaDescription = $request->input('meta_description');
        $metaKeywords = $request->input('meta_keywords');
        $excerpt = $request->input('excerpt');
        $shortDescription = $request->input('short_description');
        $content = $request->input('content');
        $category = $request->input('categories');


        $featuredImage = null;

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            if ($image->isValid()) {
                $originalExtension = $image->getClientOriginalExtension();
                $newExtension = '.webp';
                $words = Str::words($title, 5, '');
                $sanitizedTitleName = Str::slug($words);
                $uniqueName = $sanitizedTitleName . '_' . Str::random(4) . $newExtension;
                $imagePath = public_path('assets/articlesImages/' . $uniqueName);
                $image->move(public_path('assets/articlesImages/'), $uniqueName);
                $featuredImage = $uniqueName;
            }
        }

        $additionalImages = [];

        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                if ($image->isValid()) {
                    $originalExtension = $image->getClientOriginalExtension();
                    $newExtension = '.webp';
                    $words = Str::words($title, 5, '');
                    $additionalTitleName = Str::slug($words);
                    $randomString = Str::random(4);
                    $additionalName = $additionalTitleName . '_' . $randomString . $newExtension;
                    $additionalImages[] = $additionalName;
                    $imagePath = public_path('assets/articlesImages/' . $additionalName);
                    $image->move(public_path('assets/articlesImages/'), $additionalName);
                }
            }
        }

        $implodeAdditionalImages = implode(',', $additionalImages);

        $article = NewsArticles::find($id);

        if ($article) {
            $article->title = $title;
            $article->heading = $tickTitle;
            $article->excerpt = $excerpt;
            $article->meta_title = $metaTitle;
            $article->meta_description = $metaDescription;
            $article->meta_keywords = $metaKeywords;
            $article->short_description = $shortDescription;
            $article->content = $content;
            $article->category = $category;
            if ($featuredImage) {
                $article->featured_image = $featuredImage;
            }
            if ($implodeAdditionalImages) {
                $previous = $article->additional_images;
                $newImages = $implodeAdditionalImages;
                $updatedImages = $previous ? $previous . ',' . $newImages : $newImages;
                $article->additional_images = $updatedImages;
            }

            $article->save();
            return redirect()->back()->with('success', 'Article updated successfully!');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to updated article.']);
        }
    }


    public function manageArticleStatus(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');

        $article = NewsArticles::find($id);
        if ($article) {
            $article->status = $status;
            $article->save();

            return response()->json(['success' => true, 'message' => 'Article status updated successfully', 'status' => $status]);
        }
        return response()->json(['success' => false, 'message' => 'Article not found']);
    }


    public function deleteArticle(Request $request)
    {
        $id = $request->input('id');

        $article = NewsArticles::find($id);

        if ($article) {
            $article->delete();
            return response()->json(['success' => true, 'message' => 'Article deleted successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Article not found']);
    }
}
