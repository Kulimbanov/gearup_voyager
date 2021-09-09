@if(!isset($innerLoop))
    <ol class="menu-main">
        @else
            <ol class="menu-sub" aria-labelledby="<?php echo $options->id ?>">
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

                        $listItemClass = 'menu-item';
                        if(url($item->link()) == url()->current()){
                            $linkAttributes = 'class="menu-link active"';
                        }else{
                            $linkAttributes = 'class="menu-link"';
                        }

                        $isParent = !$originalItem->children->isEmpty();
                        // With Children Attributes
                        if($isParent) {
                            $options->id = \Illuminate\Support\Str::random(12);
                            $linkAttributes =  'class="menu-link" role="button" aria-expanded="false" id="' . $options->id . '"';


                            if(url($item->link()) == url()->current()){
                                $listItemClass = 'menu-item active';
                            }else{
                                $listItemClass = 'menu-item';
                            }

                        } else {
                            $options->id = null;
                        }

                        if(isset($options->id) && $originalItem->children->isEmpty()){
                            $linkAttributes = 'class="sub-menu-item"';
                            $listItemClass = '';
                        }

                    @endphp

                    <li class="{{ $listItemClass }}">
                        <a href="{{ $isParent?'#':url($item->link()) }}" target="{{ $item->target }}" {!! $linkAttributes ?? '' !!}>
                            {{ $item->title }}
                        </a>
                        @if(!$originalItem->children->isEmpty())
                            @include('voyager::menu.bootstrap', ['items' => $originalItem->children, 'options' => $options, 'innerLoop' => true])
                        @endif
                    </li>
                @endforeach

            </ol>
