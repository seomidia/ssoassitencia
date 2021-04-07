<ul class="nav navbar-nav" >

    @php

        if (Voyager::translatable($items)) {
            $items = $items->load('translations');
        }

    @endphp

    @foreach ($items as $item)

        @php

            $originalItem = $item;
            if (Voyager::translatable($item)) {
                $item = $item->translate($options->locale);
            }

            $isActive = null;
            $styles = null;
            $icon = null;

            // Background Color or Color
            if (isset($options->color) && $options->color == true) {
                $styles = 'color:'.$item->color;
            }
            if (isset($options->background) && $options->background == true) {
                $styles = 'background-color:'.$item->color;
            }

            // Set Icon
            if(isset($options->icon) && $options->icon == true){
                $icon = '<i class="' . $item->icon_class . '"></i>';
            }

        @endphp

        <li  class="@if($item->link() == url()->current()) active @endif @if(!$originalItem->children->isEmpty()) has-children  @endif ">
            <a href="{{ url($item->link()) }}" target="{{ $item->target }}" style="{{ $styles }}">
                <span class="icon {{$item->icon_class}}" style="margin-right: 6px;margin-left: 2px;"></span>
            <span>{{ $item->title }}</span>
            </a>
            @if(!$originalItem->children->isEmpty())
                @include('partials.menu.menusub', ['items' => $originalItem->children, 'options' => $options, 'class' => true])
            @endif
        </li>
    @endforeach


    </ul>
