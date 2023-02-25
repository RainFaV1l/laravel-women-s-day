@extends('layouts.app')

@section('content')
    <div class="banner">
        <div class="banner__container container">
            <div class="banner__slider banner-slider">
                <!-- Slider main container -->
                <div class="swiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <div class="swiper-slide">
                            <div class="banner-slider__container">
                                <div class="banner-slide__content">
                                    <h1 class="banner-slider__header">С международным женским днем!</h1>
                                    <div class="banner-slider__text">С Международным женским днем. Всех дам сердечно поздравляем! Пусть будет лишь успех во всем. Любви и счастья вам желаем.</div>
                                </div>
                                <div class="banner-slide__img">
                                    <img src="{{ asset('assets/images/1.jpg') }}" alt="img">
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="banner-slider__container">
                                <div class="banner-slide__content">
                                    <h1 class="banner-slider__header">Что подарить девушке?</h1>
                                    <div class="banner-slider__text">Намекните на то, что нужно больше отдыха, выбрав в качестве подарка вещи для дома. Это может быть комплект приятной к телу, уютной домашней одежды: брюки с лонгсливом, толстовкой или футболкой, — или, например, комфортное домашнее платьье. Ещё один вариант — красивая пижама для сна или ночная сорочка. Если же хочется вдобавок ко всему подчеркнуть женственность той девушки, которой адресован подарок, присмотритесь к изящным домашним халатам из шелка, сатина, вискозы или хлопка.</div>
                                </div>
                                <div class="banner-slide__img">
                                    <img src="{{ asset('assets/images/1.jpg') }}" alt="img">
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="banner-slider__container">
                                <div class="banner-slide__content">
                                    <h1 class="banner-slider__header">Совет к 8 марту.</h1>
                                    <div class="banner-slider__text">Перечислены главные способы продления жизни тюльпанам, которые уже завтра будут получать женщины на 8 марта. Лайфхаки помогут сделать так, чтобы тюльпаны стояли до 12 дней.</div>
                                </div>
                                <div class="banner-slide__img">
                                    <img src="{{ asset('assets/images/1.jpg') }}" alt="img">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- If we need pagination -->
{{--                    <div class="swiper-pagination"></div>--}}

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                    <!-- If we need scrollbar -->
                    <div class="swiper-scrollbar"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="catalog" id="catalog">
        <div class="catalog__container container">
            <div class="catalog__header">
                <h2 class="catalog__title">Каталог цветов</h2>
                <p class="catalog__subtitle">Самые лучшие цветы для вашей любимой!</p>
            </div>
            <form action="{{ route('index.search') }}" method="post">
                @csrf
                <input name="search" type="search" class="catalog__search" value="{{ old('search') }}" placeholder="Поиск по каталогу">
                <button class="button" type="submit">Поиск</button>
            </form>
            <div class="catalog__list">
                @foreach($products as $product)
                    <div class="catalog__item">
                        <div class="catalog__img">
                            <img src="{{ $product->image_url }}" alt="img">
                        </div>
                        <div class="catalog__content">
                            <div class="catalog__name">{{ $product['name'] }}</div>
                            <div class="catalog__price">Цена: <span>{{ $product['price'] }} ₽</span></div>
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user() !== null)
                            @if(\Illuminate\Support\Facades\Auth::user()->role === 1)
                                @if(\App\Models\Order::query()->get()->where('user_id', '===', \Illuminate\Support\Facades\Auth::user()->id)->where('product_id', '===', $product['id'])->toArray() === [])
                                    <form method="post" action="{{ route('product.order') }}">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                        <button type="submit" class="catalog__button button">Заказать</button>
                                    </form>
                                @endif

                            @endif
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
