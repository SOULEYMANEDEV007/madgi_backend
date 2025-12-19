<form action="{{ getGuardedRoute('certificates.store') }}" method="POST">
    @csrf
    @if(auth()->guard(\App\Models\Admin::$guard)->check())
        @livewire('admin.certificat')
    @else
        @livewire('user.certificat')
    @endif
    <div class="float-right">
        <button type="submit" class="btn btn-primary btn-sm">Valider</button>
    </div>
</form>
