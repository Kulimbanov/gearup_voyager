@if(!isset($innerLoop))
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @else
            <ul class="dropdown-menu" aria-labelledby="<?php echo $options->id ?>">
                @endif

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

                        $listItemClass = 'nav-item';
                        if(url($item->link()) == url()->current()){
                            $linkAttributes = 'class="nav-link active"';
                        }else{
                            $linkAttributes = 'class="nav-link"';
                        }
                        // With Children Attributes
                        if(!$originalItem->children->isEmpty()) {
                            $options->id = \Illuminate\Support\Str::random(12);
                            $linkAttributes =  'class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false" id="' . $options->id . '"';


                            if(url($item->link()) == url()->current()){
                                $listItemClass = ' dropdown active';
                            }else{
                                $listItemClass = ' dropdown';
                            }
                        } else {
                            $options->id = null;
                        }

                        if(isset($options->id) && $originalItem->children->isEmpty()){
                            $linkAttributes = 'class="dropdown-item"';
                            $listItemClass = '';
                        }

                    @endphp

                    <li class="{{ $listItemClass }}">
                        <a href="{{ url($item->link()) }}" target="{{ $item->target }}" {!! $linkAttributes ?? '' !!}>
                            {{ $item->title }}
                        </a>
                        @if(!$originalItem->children->isEmpty())
                            @include('voyager::menu.bootstrap', ['items' => $originalItem->children, 'options' => $options, 'innerLoop' => true])
                        @endif
                    </li>
                @endforeach

            </ul>
