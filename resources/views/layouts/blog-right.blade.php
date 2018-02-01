<div class="right" id="main_right">

    <div id="sidebar">

        <div class="box">
            <div class="box_title">Search</div>
            <div class="box_body">
                <form method="get" id="searchform" action="#">
                    <div>
                        <table class="search">
                            <tr>
                                <td><input type="text" value="" name="s" id="s" /></td>
                                <td style="padding-left: 10px"><input type="image" src="{{ asset('img') }}/button_go.gif" /></td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
            <div class="box_bottom"></div>
        </div>

        <div class="box">
            <div class="box_title">Archives</div>
            <div class="box_body">
                <ul>
                    @foreach($dateArr as $date => $num)
                        <li><a href="{{ route('blog_archives',['date' => $date]) }}">{{ $date }}</a> ({{ $num }})</li>
                    @endforeach
                </ul>
            </div>
            <div class="box_bottom"></div>
        </div>

        <div class="box">
            <div class="box_title">Tags</div>
            <div class="box_body">
                <ul>
                    @foreach($tagsArr as $tag_name => $num)
                        <li><a href="{{ route('blog_tags',['tag' => $tag_name]) }}">{{ $tag_name }}</a> ({{ $num }})</li>
                    @endforeach
                </ul>
            </div>
            <div class="box_bottom"></div>
        </div>

        <div class="box">
            <div class="box_title">Links</div>
            <div class="box_body">
                <ul>
                    <li><a href="#">Blogger Templates</a></li>
                    <li><a href="#">Joomla Templates</a></li>
                </ul>
            </div>
            <div class="box_bottom"></div>
        </div>

        <div class="box">
            <div class="box_title">Textbox</div>
            <div class="box_body p10">
                A box with some text.
            </div>
            <div class="box_bottom"></div>
        </div>

    </div>
</div>