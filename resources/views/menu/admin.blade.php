<li class="nav-item {{ Nav::isRoute('member.index') }}">
    <a class="nav-link" href="{{ route('member.index') }}">
        <i class="fas fa-fw fa-users"></i>
        <span>{{ __('Users') }}</span>
    </a>
</li>

<li class="nav-item {{ Nav::isRoute('project.category') }}">
    <a class="nav-link" href="{{ route('project.category') }}">
        <i class="fas fa-fw fa-book"></i>
        <span>{{ __('Project Categories') }}</span>
    </a>
</li>

<li class="nav-item {{ Nav::isRoute('project.status') }}">
    <a class="nav-link" href="{{ route('project.status') }}">
        <i class="fas fa-fw fa-book"></i>
        <span>{{ __('Project Status') }}</span>
    </a>
</li>

<li class="nav-item {{ Nav::isRoute('project.index') }}">
    <a class="nav-link" href="{{ route('project.index') }}">
        <i class="fas fa-fw fa-user-plus"></i>
        <span>{{ __('Project') }}</span>
    </a>
</li>

<li class="nav-item {{ Nav::isRoute('way.index') }}">
    <a class="nav-link" href="{{ route('way.index') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>{{ __('Cara Kerja') }}</span>
    </a>
</li>

<li class="nav-item {{ Nav::isRoute('slider.index') }}">
    <a class="nav-link" href="{{ route('slider.index') }}">
        <i class="fas fa-fw fa-list"></i>
        <span>{{ __('Slider') }}</span>
    </a>
</li>
