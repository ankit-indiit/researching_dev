<div class="row table_data">
              <?php
                    foreach ($blogs as $blog) { 
                       $image =  asset('/assets/img/blog/' .$blog->image); 
                      ?>
              <div class="col-md-4">
                <div class="blog_grid_post blog_image">
                  <div class="thumb">
                    <img class="img-fluid" src="{{ $image }}" alt="">
                  </div>
                  <input type="hidden" value = "{{$category_id}}" id ="pagination_categoryid">
                <div class="details">
                  <a href="{{route('front.blog.show',['slug' => $blog->slug])}}">{{$blog->title}}</a>
                  <?php 
                  $comment_count = 0;
                  $blog_comments = DB::table('blog_comments')->where('blog_id',$blog->id)->where('status',1)->get();
                  $comment_count = sizeof($blog_comments);
                  ?>

                    <ul class="post_meta">
                      <li><span class="ti-user"></span></li>
                      <li><span>ג'ון סמית</span></li>
                      <li><span class="ti-comments"></span></li>
                      <li><span>{{$comment_count}} הערות</span></li>
                    </ul>
                    <span class="readingtime">משך זמן הקריאה הוא {{$blog->reading_time}} </span>
                    <p>{{$blog->content}}</p>
                </div>
              </div>
            </div>
            <?php } ?>
            </div>
            @if ($blogs->lastPage() > 1) 
                     <ul class="pagination"> 
                      <li class="{{ ($blogs->currentPage() == 1) ? ' disabled' : '' }}"> 
                        <a href="{{ $blogs->url(1) }}">Previous</a> 
                      </li> 
                      @for ($i = 1; $i <= $blogs->lastPage(); $i++) 
                      <li class="{{ ($blogs->currentPage() == $i) ? ' active' : '' }}"> 
                        <a href="{{ $blogs->url($i) }}">{{ $i }}</a> 
                      </li> 
                      @endfor 
                      <li class="{{ ($blogs->currentPage() == $blogs->lastPage()) ? ' disabled' : '' }}">   <a href="{{ $blogs->url($blogs->currentPage()+1) }}" >Next</a> 
                      </li> 
                    </ul> 
                    @endif

                    <script type="text/javascript">
                      $(document).ready(function(){
                        var category_id = $('#pagination_categoryid').val();
                     $(document).on('click', '.pagination a', function(event){
                        event.preventDefault(); 
                        var page = $(this).attr('href').split('page=')[1];
                        fetch_data(page);
                      });
                     function fetch_data(page){
                      $.ajax({
                        url:"{{ url('blogs') }}?page="+page,
                        data:{id: category_id},
                        success:function(data){
                          console.log(data);
                         $('.table_data').html(data);
                        }
                      });
                    }
                    });
                    </script>