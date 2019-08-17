<?php
/********************************************************************
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ 
@Author			John Hoddy <john.hoddy@iconic-publishing.com>
@Website		https://www.iconic-publishing.com
@Created		Monday, 2nd April, 2018

© Copyright 2014 - 2018 Iconic Publishing Co Ltd. All Rights Reserved
~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
Change Request ID: 

~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~ ~
*********************************************************************/

namespace Base\Controllers;

use Base\{
	Constructor\BaseConstructor,
	Models\Blog
};
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

class BlogController extends BaseConstructor {
	
	public function getBlogs(Request $request, Response $response) {
		$blogs = Blog::orderBy('published_on', 'DESC')->paginate($this->config->get('blog.paginator'))->appends($request->getParams());
		$sideBar = $this->sideBar();
		
        return $this->view->render($response, 'blog/blogs.php', compact('blogs', 'sideBar'));
    }
	
	public function getBlogDetails(Request $request, Response $response, $args) {
		$slug = $args['slug'];
		$blog = Blog::where('slug', $slug)->first();
		$sideBar = $this->sideBar();
		
        return $this->view->render($response, 'blog/blog-details.php', compact('blog', 'sideBar'));
    }
	
	protected function sideBar() {
		return Blog::inRandomOrder()->limit($this->config->get('blog.sideBarLimit'))->get();
	}
	
}
