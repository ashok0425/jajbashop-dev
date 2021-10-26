<div>
    <!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
