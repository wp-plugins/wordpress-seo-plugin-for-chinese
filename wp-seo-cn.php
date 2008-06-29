<?
/*
Plugin Name: WordPress中文SEO插件
Plugin URI:  http://fairyfish.net/2008/06/27/wordpress-seo-plugin-for-chine/
Description: 根据博客内容获得中文关键词!
Author: askie
Version: Beta 0.1
Author URI: http://www.pkphp.com/

Licence:
All right reserved to Askie!

USAGE:
Just enabled plugin!
*/
$ck_version="Beta 0.1";

//一般设定
function ck_generalsetting()
{
	global $im_FontPath;
	if ($_POST['flag']=="general") 
     {
		foreach ($_POST as $key=>$value) 
		{
			if ($key=="ck_n") 
			{
				$value=$value<15?15:$value;
				$value=$value>40?40:$value;
			}
			if (strstr($key,"ck_")==$key) 
			{
				update_option($key, $value);
			}
		}
		echo '<div class="updated"><p>General setting saved!</p></div>';
     }
     $ck_n=get_option("ck_n");
	 $ck_n=$ck_n<15?15:$ck_n;
	 $ck_n=$ck_n>40?40:$ck_n;	
?>	
<div class="wrap">
<table width="100%" border="0" cellpadding="3">
<tr>
<td valign="top">
		<form name="updateoption" method="post">
		<input type="hidden" name="flag" value="general">		
		<table width="100%">
			<tr>
           		<td nowrap>自动填充文章摘要？</td>
           		<td>
           		  <input type="radio" name="ck_autoexcerpt" value="0" <?=get_option('ck_autoexcerpt')==0?" checked=\"checked\"":""?>>No 
				  <input type="radio" name="ck_autoexcerpt" value="1" <?=get_option('ck_autoexcerpt')==1?" checked=\"checked\"":""?>>Yes
				 </td>
			</tr>
			<tr><td colspan="2" width="100%" bgcolor="Black"></td></tr>
			<tr>
           		<td nowrap>摘要需要多少个汉字？</td>
           		<td>
           		  <input type="text" name="ck_discription_n" value="<?=get_option('ck_discription_n')<=100?100:get_option('ck_discription_n')?>" size="4">个(最少100个词) 
				 </td>
			</tr>
			<tr><td colspan="2" width="100%" bgcolor="Black"></td></tr>
			<tr>
           		<td nowrap>需要多少个关键词建议？</td>
           		<td>
           		  <input type="text" name="ck_n" value="<?=$ck_n?>" size="4">个(最少15个词，最多40个词) 
				 </td>
			</tr>
			<tr><td colspan="2" width="100%" bgcolor="Black"></td></tr>
			<tr>
           		<td nowrap>在文章后键入关键词么？</td>
           		<td>
           		  <input type="radio" name="ck_addckaftercontent" value="0" <?=get_option('ck_addckaftercontent')==0?" checked=\"checked\"":""?>>No 
				  <input type="radio" name="ck_addckaftercontent" value="1" <?=get_option('ck_addckaftercontent')==1?" checked=\"checked\"":""?>>Yes
				 </td>
			</tr>
			<tr><td colspan="2" width="100%" bgcolor="Black"></td></tr>

		</table>
	<p><div class="submit"><input type="submit" name="update_rp" value="<?php _e('Save!', 'update_rp') ?>"  style="font-weight:bold;" /></div></p>
	</form> 		
</td>
<td valign="top" width="250">
<?ck_sidebar();?>
</td>
</tr>
</table>	
</div>
<?php }
//sidebar
function ck_sidebar()
{
	?>
	<b>关于</b><br>
	<p align="left">
	<img src="<?=ck_getpluginUrl()?>/i.png"> <a href="http://fairyfish.net/2008/06/27/wordpress-seo-plugin-for-chine/" target="_blank">WordPress中文SEO插件</a><br>
	<img src="<?=ck_getpluginUrl()?>/i.png"> Askie's home page <a href="http://www.pkphp.com/" target="_blank">PKPHP.com</a>!
	</p>
	<hr>
	<b>支持</b><br>
	<p align="center" style="vertical-align: middle;">
    <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="image" src="https://www.paypal.com/zh_XC/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypal.com/zh_XC/i/scr/pixel.gif" width="1" height="1">
		<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
	</form>
	</p>
	<?
}
//获取插件URL
function ck_getpluginUrl()
{
	$path = dirname(__FILE__);
	$path = str_replace("\\","/",$path);
	$path = trailingslashit(get_bloginfo('wpurl')) . trailingslashit(substr($path,strpos($path,"wp-content/")));
	return $path;
}
/**
 * utf8字符串截取
 * @author kokko<kokko313@gmail.com>
 * @version 1.0 2007-10-26
 * @param string $string
 * @param int $length
 * @param string $etc
 * @param bool $count_words
 * @return string
 */
function ck_utf8_subString( $string,$length = 80,$etc='...',$count_words = true ) 
{
// mb_internal_encoding("UTF-8");
 $wordscut="";
 if ($length == 0) return '';
 if ( strlen( $string ) <= $length ) return $string;
 preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $info);
 
 if( $count_words )
 {
  $j = 0;
  for($i=0; $i<count($info[0]); $i++) 
  {
	   $wordscut .= $info[0][$i];
	   if( ord( $info[0][$i] ) >=128 )
	   {
	    	$j = $j+2;
	   }
	   else
	   {
	    	$j = $j + 1;
	   }
	   if ($j >= $length ) 
	   {
	     return $wordscut.$etc;
	   }
  }
  return join('', $info[0]);
 }
 return join("",array_slice( $info[0],0,$length ) ).$etc;
}
//根据文章内容分词
function ck_addCKaftercontent($content)
{
	global $id;
	$oldchineseKeywords = get_post_meta($id, "chinesekeys", true);
	if ($oldchineseKeywords=="") 
	{
		$chineseKeywords=ck_getckeys($id);
		add_post_meta($id, 'chinesekeys', $chineseKeywords);
	}
	else 
	{
		$chineseKeywords=$oldchineseKeywords;
	}
	
	$content.="<br>中文关键字：<font color='blue'>".$chineseKeywords."</font><br>";
	return $content;
}
//根据内容分词
function ck_getchinesekeys($post)
{
	global $id,$wpdb;
	//保存中文分词
	$chineseKeywords=ck_getckeys($id);
	$oldchineseKeywords = get_post_meta($id, "chinesekeys", true);
	if ($oldchineseKeywords=="") 
	{
		add_post_meta($id, 'chinesekeys', $chineseKeywords);
	}
	//自动填充摘要
	if (get_option("ck_autoexcerpt")==1) 
	{
		if (is_numeric($post)) 
		{
			$postid=$post;
			$post=array(get_post($post));
		}
		foreach ($post as $key=>$var) 
		{
			if ($post[$key]->post_excerpt == "") 
			{
				$n=get_option("ck_discription_n");$n=$n<100?100:$n;
			    $ccontent=strip_tags($post[$key]->post_content);
				$post[$key]->post_excerpt = strtolower(get_option("blog_charset"))=="utf-8"?ck_utf8_subString($ccontent,$n):substr($ccontent,0,$n);
				$wpdb->query("UPDATE `{$wpdb->posts}` SET `post_excerpt` = '{$post[$key]->post_excerpt}' WHERE `ID` = '{$post[$key]->ID}'");
			}  
			
		}
	}
}
//获取关键词
function ck_getckeys($pid)
{
	$apost = get_post($pid);
	$data["charset"]=get_option("blog_charset");
	$data["blogname"]=get_option("blogname");
	$data["blogurl"]=get_option("siteurl");
	$data["blogdescription"]=get_option("blogdescription");
	$data["title"]	=$apost->post_title;
	$data["body"]	=$apost->post_content;
	$data["n"]		=get_option("ck_n");
	$data["permlink"]=get_permalink($pid);
	$data["tags"]	=implode("#|#",array_unique(ck_getSysTags()));
	$data["cats"]	=implode("#|#",array_unique(ck_getCats()));
	$data["metas"]	=implode("#|#",array_unique(ck_getMetas()));
	$data["intags"]	=implode("#|#",ck_getPostTags($pid));
	
	$chineseKeywords=ck_virtualPost("http://www.iaska.cn/cnkeys.php",$data);
	return $chineseKeywords;
}
//获取本地tags
function ck_ajax_getLocalTags()
{
	$localTags=array_unique(ck_getSysTags());
	foreach ($localTags as $key) 
	{
		if($key<>"") $keystags[]="<span>".$key."</span>";
	}
	return @implode(" ",$keystags);
}
//根据编辑器内容分词
function ck_ajax_getKeywords_from_editor()
{
	$data["charset"]=get_option("blog_charset");
	$data["title"]	=$_POST["title"];
	$data["body"]	=$_POST["content"];
	$data["n"]		=get_option("ck_n");
	$data["intags"]	=str_replace(",","#|#",$_POST["tags"]);
	$chineseKeywords=ck_virtualPost("http://www.iaska.cn/cnkeys.php?cmd=editor",$data);
	$cnkeys=explode(" ",$chineseKeywords);
	foreach ($cnkeys as $key) 
	{
		if($key<>"") $keystags[]="<span>".$key."</span>";
	}
	return @implode(" ",$keystags);
}
//post提交数据
function ck_virtualPost($url, $data) 
{
	$url = parse_url($url);
	if (!$url) return;
	if (!isset($url['port']))  $url['port'] = "";
	if (!isset($url['query'])) $url['query'] = ""; 
	$encoded = "";
	while (list($k,$v) = each($data)) 
	{
		$encoded .= ($encoded ? "&" : "");
		$encoded .= rawurlencode($k)."=".rawurlencode($v);
	}
	$fp = fsockopen($url['host'], $url['port'] ? $url['port'] : 80);
	if (!$fp) return;
	//发送
	fputs($fp, sprintf("POST %s%s%s HTTP/1.0\n", $url['path'], $url['query'] ? "?" : "", $url['query']));
	fputs($fp, "Host: $url[host]\n");
	fputs($fp, "Content-type: application/x-www-form-urlencoded\n");
	fputs($fp, "Content-length: " . strlen($encoded) . "\n");
	fputs($fp, "Connection: close\n\n");
	fputs($fp, "$encoded\n");
	//接受
	$line = fgets($fp,1024);
	if (!eregi("^HTTP/1\.. 200", $line)) return "";
	//滤掉空行
	$results = "";
	$inheader = 1;
	while(!feof($fp)) 
	{
		$line = fgets($fp,1024);
		//把剩余的头信息过滤掉
		if ($inheader && ($line == "\n" || $line == "\r\n")) 
		{
			$inheader = 0;
		}
		elseif (!$inheader) 
		{
			$results .= $line;
		}
	}
	fclose($fp);
	return $results;
}
//获取文章tags
function ck_getPostTags($id)
{
	$gettags = get_the_tags($id);
	
	if ( !empty( $gettags ) )
	{
		foreach ($gettags as $tag) 
		{
			$posttags[] = $tag->name;
		}
	}
	return (array)$posttags;
}
//变更meta
function ck_head() 
{
	if (is_feed()) 
	{
		return;
	}
	
	global $wp_query,$post,$ck_version;
	$post = $wp_query->get_queried_object();
	$meta_string = null;
	
	if (is_single() || is_page()) 
	{
	    if ($post->post_excerpt) 
	    {
	    	$description 	= $post->post_excerpt;
	    }
	    else 
	    {
	    	$n=get_option("ck_discription_n");$n=$n<100?100:$n;
	    	$description = strtolower(get_option("blog_charset"))=="utf-8"?ck_utf8_subString($post->post_content,$n):substr($post->post_content,0,$n);
	    }
	    $keywords = ck_getPostTags($post->ID);
	} 
	else if (is_home()) 
	{
		$description=get_option('blogdescription');
	} 
	else if (is_category()) 
	{
		$description = category_description();
		$keywords	 = array($catname);
	}
	
	if (isset($description) && strlen($description) > 20) 
	{
		$description = trim(strip_tags($description));
		$description = str_replace('"', '', $description);
		
		// replace newlines on mac / windows?
		$description = str_replace("\r\n", ' ', $description);
		
		// maybe linux uses this alone
		$description = str_replace("\n", ' ', $description);
		
		if (isset($meta_string)) 
		{
			$meta_string .= "\n";
		} else {
			$meta_string = '';
		}
		
		$meta_string .= sprintf("<meta name=\"description\" content=\"%s\"/>", $description);
	}
	
	if (isset ($keywords) && !empty($keywords)) 
	{
		if (isset($meta_string)) 
		{
			$meta_string .= "\n";
		}
		$meta_string .= sprintf("<meta name=\"keywords\" content=\"%s\"/>", implode(",",$keywords));
	}
	
	if ($meta_string != null) 
	{
		echo "<!-- Start of meta info created by chinesekeywordsSEO{$ck_version} Plugin by http://www.pkphp.com/ -->\n";
		echo "$meta_string\n";
		echo "<!-- End of meta info created by chinesekeywordsSEO{$ck_version} Plugin by http://www.pkphp.com/ -->\n\n";
	}	
}
function ck_getMetas() 
{
	global $id;
	$post=get_post($id);
	$keywords = array();
    if ($post) 
    {
        // custom field keywords
        $keywords_a = $keywords_i = null;
        $description_a = $description_i = null;
        $id = $post->ID;
        $keywords_i = stripcslashes(get_post_meta($post->ID, "keywords", true));
        $keywords_i = str_replace('"', '', $keywords_i);
        if (isset($keywords_i) && !empty($keywords_i)) 
        {
            $keywords[] = $keywords_i;
        }
        
        // WP 2.3 tags
        if (function_exists('get_the_tags')) 
        {
        	$tags = get_the_tags($post->ID);
        	if ($tags && is_array($tags)) 
        	{
            	foreach ($tags as $tag) 
            	{
            		$keywords[] = $tag->name;
            	}
        	}
        }

        // Ultimate Tag Warrior integration
        global $utw;
        if ($utw) 
        {
        	$tags = $utw->GetTagsForPost($post);
        	foreach ($tags as $tag) 
        	{
				$tag = $tag->tag;
				$tag = str_replace('_',' ', $tag);
				$tag = str_replace('-',' ',$tag);
				$tag = stripcslashes($tag);
        		$keywords[] = $tag;
        	}
        }
        
        // autometa
        $autometa = stripcslashes(get_post_meta($post->ID, "autometa", true));
        if (isset($autometa) && !empty($autometa)) 
        {
        	$autometa_array = explode(' ', $autometa);
        	foreach ($autometa_array as $e) 
        	{
        		$keywords[] = $e;
        	}
        }

    	if (!is_page()) 
    	{
            $categories = get_the_category($post->ID);
            foreach ($categories as $category) 
            {
            	$keywords[] = $category->cat_name;
            }
            
            
    	}
	}
	return $keywords;
}
//获取系统分类
function ck_getCats()
{
	$allcats=get_categories();
    foreach ($allcats as $category) 
    {
    	$keywords[] = $category->cat_name;
    }
    return $keywords;
}
//获取系统tags
function ck_getSysTags()
{
	$all=ck_getTags();
	$tags=array();
	foreach ($all as $tag) 
	{
		$tags[]=$tag->name;
	}
	
	return $tags;
}
/**
	 * Extended get_tags function that use getTerms function
	 *
	 * @param string $args
	 * @return array
	 */
function ck_getTags( $args = '', $skip_cache = false, $taxonomy = 'post_tag' ) 
{
	$key = md5(serialize($args));

	if ( $skip_cache == true ) 
	{
		$terms = ck_getTerms( $taxonomy, $args, $skip_cache );
	} 
	else 
	{
		// Get cache if exist
		if ( $cache = wp_cache_get( 'st_get_tags', 'simpletags' ) ) 
		{
			if ( isset( $cache[$key] ) ) 
			{
				return apply_filters('get_tags', $cache[$key], $args);
			}
		}

		// Get tags
		$terms = ck_getTerms( $taxonomy, $args, $skip_cache );

		if ( empty($terms) ) 
		{
			return array();
		}

		$cache[$key] = $terms;
		wp_cache_set( 'st_get_tags', $cache, 'simpletags' );
	}

	$terms = apply_filters('get_tags', $terms, $args);
	return $terms;
}

/**
 * Extended get_terms function support
 *  - Limit category
 *  - Limit days
 *  - Selection restrict
 *  - Min usage
 *
 * @param string|array $taxonomies
 * @param string $args
 * @return array
 */
function ck_getTerms( $taxonomies, $args = '', $skip_cache = false ) 
{
	global $wpdb;

	$single_taxonomy = false;
	if ( !is_array($taxonomies) ) {
		$single_taxonomy = true;
		$taxonomies = array($taxonomies);
	}

	foreach ( (array) $taxonomies as $taxonomy ) {
		if ( !is_taxonomy($taxonomy) ) {
			return new WP_Error('invalid_taxonomy', __('Invalid Taxonomy'));
		}
	}

	$in_taxonomies = "'" . implode("', '", $taxonomies) . "'";

	$defaults = array(
		'cloud_selection' => 'count-desc',
		'hide_empty' => true,
		'exclude' => '',
		'include' => '',
		'number' => '',
		'fields' => 'all',
		'slug' => '',
		'parent' => '',
		'hierarchical' => true,
		'child_of' => 0,
		'get' => '',
		'name__like' => '',
		'st_name_like' => '',
		'pad_counts' => false,
		'limit_days' => 0,
		'category' => 0,
		'min_usage' => 0
	);

	$args = wp_parse_args( $args, $defaults );

	if ( !$single_taxonomy || !is_taxonomy_hierarchical($taxonomies[0]) || '' != $args['parent'] ) {
		$args['child_of'] = 0;
		$args['hierarchical'] = false;
		$args['pad_counts'] = false;
	}

	if ( 'all' == $args['get'] ) {
		$args['child_of'] = 0;
		$args['hide_empty'] = 0;
		$args['hierarchical'] = false;
		$args['pad_counts'] = false;
	}
	extract($args, EXTR_SKIP);

	if ( $child_of ) {
		$hierarchy = _get_term_hierarchy($taxonomies[0]);
		if ( !isset($hierarchy[$child_of]) ) {
			return array();
		}
	}

	if ( $parent ) {
		$hierarchy = _get_term_hierarchy($taxonomies[0]);
		if ( !isset($hierarchy[$parent]) ) {
			return array();
		}
	}

	if ( $skip_cache != true ) {
		// Get cache if exist
		$key = md5( serialize( $args ) . serialize( $taxonomies ) );
		if ( $cache = wp_cache_get( 'get_terms', 'terms' ) ) {
			if ( isset( $cache[$key] ) ) {
				return apply_filters('get_terms', $cache[$key], $taxonomies, $args);
			}
		}
	}

	// Restrict category
	$category_sql = '';
	if ( !empty($category) && $category != '0' ) {
		$incategories = preg_split('/[\s,]+/', $category);

		$objects_id = get_objects_in_term( $incategories, 'category' );
		$objects_id = array_unique ($objects_id); // to be sure haven't duplicates

		if ( empty($objects_id) ) { // No posts for this category = no tags for this category
			return array();
		}

		foreach ( (array) $objects_id as $object_id ) {
			$category_sql .= "'". $object_id . "', ";
		}

		$category_sql = substr($category_sql, 0, strlen($category_sql) - 2); // Remove latest ", "
		$category_sql = 'AND p.ID IN ('.$category_sql.')';
	}

	// count-asc/count-desc/name-asc/name-desc/random
	$cloud_selection = strtolower($cloud_selection);
	switch ( $cloud_selection ) {
		case 'count-asc':
			$order_by = 'tt.count ASC';
			break;
		case 'random':
			$order_by = 'RAND()';
			break;
		case 'name-asc':
			$order_by = 't.name ASC';
			break;
		case 'name-desc':
			$order_by = 't.name DESC';
			break;
		default: // count-desc
			$order_by = 'tt.count DESC';
			break;
	}

	// Min usage
	$restict_usage = '';
	$min_usage = (int) $min_usage;
	if ( $min_usage != 0 ) {
		$restict_usage = ' AND tt.count >= '. $min_usage;
	}

	$where = '';
	$inclusions = '';
	if ( !empty($include) ) {
		$exclude = '';
		$interms = preg_split('/[\s,]+/',$include);
		foreach ( (array) $interms as $interm ) {
			if (empty($inclusions)) {
				$inclusions = ' AND ( t.term_id = ' . intval($interm) . ' ';
			} else {
				$inclusions .= ' OR t.term_id = ' . intval($interm) . ' ';
			}
		}
	}

	if ( !empty($inclusions) ) {
		$inclusions .= ')';
	}
	$where .= $inclusions;

	$exclusions = '';
	if ( !empty($exclude) ) {
		$exterms = preg_split('/[\s,]+/',$exclude);
		foreach ( (array) $exterms as $exterm ) {
			if (empty($exclusions)) {
				$exclusions = ' AND ( t.term_id <> ' . intval($exterm) . ' ';
			} else {
				$exclusions .= ' AND t.term_id <> ' . intval($exterm) . ' ';
			}
		}
	}

	if ( !empty($exclusions) ) {
		$exclusions .= ')';
	}
	$exclusions = apply_filters('list_terms_exclusions', $exclusions, $args );
	$where .= $exclusions;

	if ( !empty($slug) ) {
		$slug = sanitize_title($slug);
		$where .= " AND t.slug = '$slug'";
	}

	if ( !empty($name__like) ) {
		$where .= " AND t.name LIKE '{$name__like}%'";
	}

	if ( strpos($st_name_like, ' ') != false || strpos($st_name_like, ' ') != null ) {
		$tmp = '';
		$sts = explode(' ', $st_name_like);
		foreach ( (array) $sts as $st ) {
			if ( empty($st) )
				continue;
				
			$st = addslashes_gpc($st);
			$tmp .= " t.name LIKE '%{$st}%' OR ";
		}
		// Remove latest OR
		$tmp = substr( $tmp, 0, strlen($tmp) - 4);

		$where .= " AND ( $tmp ) ";
		unset($tmp)	;
	} elseif ( !empty($st_name_like) ) {
		$where .= " AND t.name LIKE '%{$st_name_like}%'";
	}

	if ( '' != $parent ) {
		$parent = (int) $parent;
		$where .= " AND tt.parent = '$parent'";
	}

	if ( $hide_empty && !$hierarchical ) {
		$where .= ' AND tt.count > 0';
	}

	$number_sql = '';
	if ( strpos($number, ',') != false || strpos($number, ',') != null ) {
		$number_sql = $number;
	} else {
		$number = (int) $number;
		if ( $number != 0 ) {
			$number_sql = 'LIMIT ' . $number;
		}
	}

	if ( 'all' == $fields ) {
		$select_this = 't.*, tt.*';
	} else if ( 'ids' == $fields ) {
		$select_this = 't.term_id';
	} else if ( 'names' == $fields ) {
		$select_this = 't.name';
	}

	// Limit posts date
	$limitdays_sql = '';
	$limit_days = (int) $limit_days;
	if ( $limit_days != 0 ) {
		$limitdays_sql = 'AND p.post_date_gmt > "' .date( 'Y-m-d H:i:s', time() - $limit_days * 86400 ). '"';
	}

	$query = "SELECT {$select_this}
		FROM {$wpdb->terms} AS t
		INNER JOIN {$wpdb->term_taxonomy} AS tt ON t.term_id = tt.term_id
		INNER JOIN {$wpdb->term_relationships} AS tr ON tt.term_taxonomy_id = tr.term_taxonomy_id
		INNER JOIN {$wpdb->posts} AS p ON tr.object_id = p.ID
		WHERE tt.taxonomy IN ( {$in_taxonomies} )
		AND p.post_date_gmt < '".current_time('mysql')."'
		{$limitdays_sql}
		{$category_sql}
		{$where}
		{$restict_usage}
		GROUP BY t.term_id
		ORDER BY {$order_by}
		{$number_sql}";

	if ( 'all' == $fields ) {
		$terms = $wpdb->get_results($query);
		if ( $skip_cache != true ) {
			update_term_cache($terms);
		}
	} elseif ( 'ids' == $fields ) {
		$terms = $wpdb->get_col($query);
	}

	if ( empty($terms) ) {
		return array();
	}

	if ( $child_of || $hierarchical ) {
		$children = _get_term_hierarchy($taxonomies[0]);
		if ( ! empty($children) ) {
			$terms = & _get_term_children($child_of, $terms, $taxonomies[0]);
		}
	}

	// Update term counts to include children.
	if ( $pad_counts ) {
		_pad_term_counts($terms, $taxonomies[0]);
	}

	// Make sure we show empty categories that have children.
	if ( $hierarchical && $hide_empty ) {
		foreach ( (array) $terms as $k => $term ) {
			if ( ! $term->count ) {
				$children = _get_term_children($term->term_id, $terms, $taxonomies[0]);
				foreach ( (array) $children as $child ) {
					if ( $child->count ) {
						continue 2;
					}
				}

				// It really is empty
				unset($terms[$k]);
			}
		}
	}
	reset($terms);

	if ( $skip_cache != true ) {
		$cache[$key] = $terms;
		wp_cache_set( 'get_terms', $cache, 'terms' );
	}

	$terms = apply_filters('get_terms', $terms, $taxonomies, $args);
	return $terms;
}
/**
 * ajax发布
 *
 */
function ck_ajaxCheck() 
{
	if ( $_GET['ck_ajax_action'] == 'suggestcnkeys' ) 
	{
		ck_ajaxListTags(ck_ajax_getKeywords_from_editor());
	}
	if ( $_GET['ck_ajax_action'] == 'getlocaltags' ) 
	{
		ck_ajaxListTags(ck_ajax_getLocalTags());
	}
}
//保存tags
function ck_saveTags( $post_id = null, $post_data = null ) 
{
	$object = get_post($post_id);
	if ( $object == false || $object == null ) 
	{
		return false;
	}
	
	if ( isset($_POST['cktags-input']) ) 
	{
		// Post data
		$tags = stripslashes($_POST['cktags-input']);
		
		// Trim data
		$tags = trim(stripslashes($tags));

		// String to array
		$tags = explode( ',', $tags );

		// Remove empty and trim tag
		$tags = array_filter($tags, 'ck_deleteEmptyElement');

		// Add new tag (no append ! replace !)
		wp_set_object_terms( $post_id, $tags, 'post_tag' );
		//exit();
		// Clean cache
		if ( 'page' == $object->post_type ) 
		{
			clean_page_cache($post_id);
		} 
		else 
		{
			clean_post_cache($post_id);
		}
		
		return true;
	}
	return false;
}
/**
 * 去除空的数组值
 *
 * @param string $element
 * @return string
 */
function ck_deleteEmptyElement( &$element ) 
{
	$element = stripslashes($element);
	$element = trim($element);
	if ( !empty($element) ) 
	{
		return $element;
	}
}
/**
* ajax返回tags
*
*/
function ck_ajaxListTags($str) 
{
	status_header( 200 );
	header("Content-Type: text/javascript; charset=" . get_bloginfo('charset'));
	echo $str;
}
function ck_remplaceTagsHelper() 
{
?>
<script type="text/javascript">
/* <![CDATA[ */
	function ck_getContentFromEditor() {
	var data = '';
	if ( (typeof tinyMCE != "undefined") && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden() ) { // Tiny MCE
		tinyMCE.triggerSave();
		data = document.getElementById("content").innerHTML;
	} else if ( typeof FCKeditorAPI != "undefined" ) { // FCK Editor
		var oEditor = FCKeditorAPI.GetInstance('content') ;
		data = oEditor.GetHTML().stripTags();
	} else if ( typeof WYM_INSTANCES != "undefined" ) { // Simple WYMeditor
		data = WYM_INSTANCES[0].xhtml().stripTags();
	} else { // No editor, just quick tags
		data = document.getElementById("content").innerHTML;
	}
	return data;
}

	function ck_addTag(tag) {
		var tag_entry = document.getElementById("cktags-input");
		if ( tag_entry.value.length > 0 && !tag_entry.value.match(/,\s*$/) ) {
			tag_entry.value += ", ";
		}
		var re = new RegExp(tag + ",");
		if ( !tag_entry.value.match(re) ) {
			tag_entry.value += tag + ", ";
		}
	}
	jQuery(document).ready(function() {
		jQuery("#tagsdiv").after('<div id="cktagsdiv" class="postbox if-js-closed"><h3><img id="local_loading" style="float:right;display:none;" src="../wp-content/plugins/wp-seo-cn/loader.gif"><div id="getlocaltags" style="color:blue;float:right;" class="ck_menu">本地tags</div><div style="color:blue;float:right;" class="ck_menu">&nbsp;|&nbsp;</div><div id="getck" style="color:red;float:right;" class="ck_menu">pkphp关键词建议</div><img id="ck_loading" style="float:right;display:none;" src="../wp-content/plugins/wp-seo-cn/loader.gif">关键词建议：(多个关键词使用英文逗号隔开)</h3><div class="inside"><input type="text" name="cktags-input" id="cktags-input" size="40" tabindex="3" style="width:98%;" value="" /><div id="cksuggestlist"></div><div id="localtagslist"></div></div></div>');
		jQuery("#tagsdiv").hide();
		jQuery("#cktags-input").attr("value",jQuery("#tags-input").val());
		
		jQuery("#getck").click(function() {
			jQuery("#ck_loading").show("fast");
			jQuery("#cksuggestlist")
			.fadeIn('slow')
			.load( '<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?ck_ajax_action=suggestcnkeys', {content:ck_getContentFromEditor(),title:jQuery("#title").val(),tags:jQuery("#tags-input").val()}, function(){
				jQuery("#cksuggestlist span").click(function() { ck_addTag(this.innerHTML); return false;});
				});
			jQuery("#ck_loading").hide("slow");	
		});
		jQuery("#getck").mouseover(function() {
			jQuery("#getck").css("background","#CCCCCC");
		});
		jQuery("#getck").mouseout(function() {
			jQuery("#getck").css("background","");
		});
		
		jQuery("#getlocaltags").click(function() {
			jQuery("#local_loading").show("fast");
			jQuery("#localtagslist")
			.fadeIn('slow')
			.load( '<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?ck_ajax_action=getlocaltags', function(){
				jQuery("#localtagslist span").click(function() { ck_addTag(this.innerHTML); return false;});
				});
			jQuery("#local_loading").hide("slow");	
		});
		jQuery("#getlocaltags").mouseover(function() {
			jQuery("#getlocaltags").css("background","#CCCCCC");
		});
		jQuery("#getlocaltags").mouseout(function() {
			jQuery("#getlocaltags").css("background","");
		});
	});
/* ]]> */
</script>
<style type="text/css">
#tagsdiv { display:none; }
/* Ajax Click Tags */
#cksuggestlist { padding:6px; border:2px dashed #FF0000; margin:3px 0 0; display:none;max-height:300px;overflow:auto; }
#localtagslist { padding:6px; border:2px dashed #0000FF; margin:3px 0 0; display:none;max-height:300px;overflow:auto; }
/* Click Tags */
#cksuggestlist span{font-size: 12px;}
#cksuggestlist span{display:block;float:left;background:#f0f0ee;border:solid 1px;color:#333;cursor:pointer;border-color:#ccc #999 #999 #ccc;margin:3px;padding-left:4px;padding-top: 3px;padding-right: 4px;padding-bottom: 3px;}
#cksuggestlist span:hover{color:#000;background:#b6bdd2;border-color:#0a246a;}
#cksuggestlist span.local{background:#f0f0ee;}
#cksuggestlist span.local:hover{background:#b6bdd2;}

#localtagslist span{font-size: 12px;}
#localtagslist span{display:block;float:left;background:#f0f0ee;border:solid 1px;color:#333;cursor:pointer;border-color:#ccc #999 #999 #ccc;margin:3px;padding-left:4px;padding-top: 3px;padding-right: 4px;padding-bottom: 3px;}
#localtagslist span:hover{color:#000;background:#b6bdd2;border-color:#0a246a;}
#localtagslist span.local{background:#f0f0ee;}
#localtagslist span.local:hover{background:#b6bdd2;}

.ck_menu{padding-top: 2px;padding-right: 1px;padding-bottom: 2px;padding-left: 1px;}
</style>	   
<?php
}
//添加菜单
function ck_admin_menu() 
{
	if (function_exists('add_options_page')) 
	{ 
		add_options_page('WordPress SEO 中文插件', 'WordPress SEO 中文插件', 8, basename(__FILE__), 'ck_generalsetting');
	}
}
//内容之后加入中文关键字
if (get_option("ck_addckaftercontent")==1) 
{
	add_filter('the_content',"ck_addCKaftercontent");
}
//tags建议助手
add_action('admin_head', 'ck_remplaceTagsHelper');
add_action('init', 'ck_ajaxCheck');
//保存tags
add_action('save_post', 'ck_saveTags');
add_action('publish_post', 'ck_saveTags');	
//输出meta
add_filter('wp_head', 'ck_head');
//获取关键词
add_action('edit_post', 	'ck_getchinesekeys');
add_action('edit_page', 	'ck_getchinesekeys');
add_action('publish_post', 	'ck_getchinesekeys');
add_action('publish_page', 	'ck_getchinesekeys');
//加入菜单
add_action('admin_menu', 'ck_admin_menu');
?>