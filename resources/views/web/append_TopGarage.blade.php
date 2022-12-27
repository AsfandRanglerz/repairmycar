@if (count($garages) > 0)
    @foreach ($garages as $value)
        <div class="col-lg-3 col-md-4 col-sm-4">
            <a href="{{ route('gerage_detail', $value->id) }}">
                <div class="card card_vendors shadow">
                    <div class="car_img_wrapper all_garages">
                        <img @if ($value->image && $value->image != null) src="{{ asset($value->image) }}" @else src="{{ asset('public/assets/images/repair2.jpg') }}" @endif
                            class="card-img-top" alt="Car image">
                    </div>
                    <div class="card-body p-sm-2">
                        <h6 class="block-head-txt text-center">{{ $value->garage_name }}</h6>
                        <h5 class="card-title text-center allgarages_card_title"><span>{{$value->rating}}</span></h5>
                        <div class="card_icons d-flex justify-content-center align-items-center">
                            <?php $category = \App\Models\GarageCategory::where('garage_id', $value->id)->pluck('category_id');
                            $category_name = \App\Models\Category::whereIn('id', $category)->get();
                            $count = $category_name->count();
                            if ($count > 5) {
                                $count = 5;
                            }
                            ?>
                            @for ($i = 0; $i < $count; $i++)
                                <div class="icon_wrpaer">
                                    <img src="{{ asset($category_name[$i]->icon) }}">
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
@else
    Oops... Sorry no garrages found related to this category service !
@endif
<div class="row">
    <div class="col-lg-8 mx-auto text-center">
        <nav aria-label="..." class="d-flex align-items-center justify-content-center">
            <span class="mt-4">{!! $garages->links() !!}</span>
        </nav>
    </div>
</div>