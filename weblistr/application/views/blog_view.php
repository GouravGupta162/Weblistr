<base href="<?php echo base_url(); ?>" />
<script type="text/javascript" src="js/jquery.js"></script>

<style type="text/css">
.read-blog {
    width: 100%;
    float: left;
    background-color: #f2f2f2;
    padding: 10px;
    margin-bottom: 20px;
    box-shadow: 1px 1px 2px #ccc;
	font-family:Arial, Helvetica, sans-serif;
}
.blog-pic {
    float: left;
    width: 90%;
}
.blog-pic h5 {
    margin-top: 0px;
    margin-bottom: 0px;
}
.blog-pic > img {
    border-radius: 4px;
    float: left;
    height: 70px;
    margin-right: 10px;
    width: 70px;
}
.read-more h5 {
    float: right;
    font-size: 14px;
    color: #0d7d7a;
    margin-top: 0;
    margin-right: 13px;
    margin-bottom: 7px;
}
.blog-pic h6 {
    color: #333;
    font-size: 12px;
    margin-left: 80px;
    font-weight: normal;
    line-height: 1.4;
	font-family:Arial, Helvetica, sans-serif;
	margin-top:0px;
	margin-bottom:0px;
}
.blog-pic h6 p{ margin-bottom:0px;}
.read-more {
    float: left;
    font-size: 14px;
    color: #b6b6b6;
    width: 100%;
    margin-top: 10px;
}
.read-more h6 {
    color: #333;
    float: left;
    font-size: 14px;
    margin-right: 10px;
    margin-top: 0px;
    margin-bottom: 0px;
}
.read-more h5 {
    float: right;
    font-size: 14px;
    color: #0d7d7a;
    margin-top: 0;
    margin-right: 13px;
}
.fa.fa-angle-right {
    float: right;
    font-size: 17px;
    margin-left: 5px;
}
.blog-pic h2{ color: #333;
    float: left;
    font-size: 14px;
    margin-right: 10px;}



</style>

<script type="text/javascript">
var MYBLOG_LIMIT = 2;
var MYWRAPPER_CLASS = 'homeblog';

var WP = {
    open: function(b) {
        var a = {
            posts: function() {
                var d = MYBLOG_LIMIT;
                var e = 0;
                var c = {
                    all: function(g) {
                        var f = b + "/api/get_recent_posts/";
                        f += "?count=" + d + "&page=" + e + "&callback=?";
                        jQuery.getJSON(f, function(l) {
                            var k = l.posts;
                            for (var j = 0; j < k.length; j++) {
                                var h = k[j];
                                h.createComment = function(i, m) {
                                    i.postId = h.id;
                                    a.comments().create(i, m)
                                }
                            }
                            g(k)
                        })
                    },
                    findBySlug: function(f, h) {
                        var g = b + "/api/get_post/";
                        g += "?slug=" + f + "&callback=?";
                        jQuery.getJSON(g, function(i) {
                            h(i.post)
                        })
                    },
                    limit: function(f) {
                        d = f;
                        return c
                    },
                    page: function(f) {
                        e = f;
                        return c
                    }
                };
                return c
            },
            pages: function() {
                var c = {
                    findBySlug: function(d, f) {
                        var e = b + "/api/get_page/";
                        e += "?slug=" + d + "&callback=?";
                        jQuery.getJSON(e, function(g) {
                            f(g.page)
                        })
                    }
                };
                return c
            },
            categories: function() {
                var c = {
                    all: function(e) {
                        var d = b + "/api/get_category_index/";
                        d += "?callback=?";
                        jQuery.getJSON(d, function(f) {
                            e(f.categories)
                        })
                    }
                };
                return c
            },
            tags: function() {
                var c = {
                    all: function(e) {
                        var d = b + "/api/get_tag_index/";
                        d += "?callback=?";
                        jQuery.getJSON(d, function(f) {
                            e(f.tags)
                        })
                    }
                };
                return c
            },
            comments: function() {
                var c = {
                    create: function(f, e) {
                        var d = b + "/api/submit_comment/";
                        d += "?post_id=" + f.postId + "&name=" + f.name + "&email=" + f.email + "&content=" + f.content + "&callback=?";
                        jQuery.getJSON(d, function(g) {
                            e(g)
                        })
                    }
                };
                return c
            }
        };
        return a
    }
};

var blog = WP.open('http://theweblisters.com/blog/');
blog.posts().all(function(posts){
	console.log(posts[0]);
	var objStaticHTML = StaticHTML().QuizTitle;		
	for(var i = 0; i < posts.length; i++){
    jQuery('.'+MYWRAPPER_CLASS).append(function(){
		return  objStaticHTML.replace("{@image}", posts[i].thumbnail).replace("{@title}",posts[i].title).replace("{@link}",posts[i].url).replace("{@description}",posts[i].content.substring(0,200));//.replace("{@time}",posts[i].date.substring(0,10));
    });
  }
});

function StaticHTML() {
	var QuizTitle = "<div class='read-blog'><div class='blog-pic'><img src='{@image}' width='100%' alt='profile-pic'><h5>{@title}</h5><h6>{@description} </h6></div><div class='read-more'><h6></h6><a href='{@link}' target='_blank' ><h5>Read More <i class='fa fa-angle-right'></i></h5></a></div></div>";
	//var QuizTitle = "<div class='read-blog'><div class='blog-pic'><img src='{@image}' width='100%' alt='profile-pic'><h5>{@title}</h5><h6>{@description} </h6></div><div class='read-more'><h6>{@time}</h6><a href='{@link}' target='_blank' ><h5>Read More <i class='fa fa-angle-right'></i></h5></a></div></div>";
	return { QuizTitle: QuizTitle };
}
</script>
<div class="homeblog">
</div>​

