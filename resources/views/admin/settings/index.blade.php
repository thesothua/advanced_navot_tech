@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Site Settings</h1>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">General Settings</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="site_name" class="form-label">Site Name *</label>
                            <input type="text" class="form-control @error('site_name') is-invalid @enderror"
                                id="site_name" name="site_name" value="{{ old('site_name', $settings->site_name ?? '') }}"
                                required>
                            @error('site_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="site_description" class="form-label">Site Description</label>
                            <textarea class="form-control @error('site_description') is-invalid @enderror" id="site_description"
                                name="site_description" rows="3">{{ old('site_description', $settings->site_description ?? '') }}</textarea>
                            @error('site_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="footer_description" class="form-label">Footer Description</label>
                            <textarea class="form-control @error('footer_description') is-invalid @enderror" id="footer_description"
                                name="footer_description" rows="3">{{ old('footer_description', $settings->footer_description ?? '') }}</textarea>
                            @error('footer_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contact_email" class="form-label">Contact Email</label>
                                    <input type="email" class="form-control @error('contact_email') is-invalid @enderror"
                                        id="contact_email" name="contact_email"
                                        value="{{ old('contact_email', $settings->contact_email ?? '') }}">
                                    @error('contact_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="contact_phone" class="form-label">Contact Phone</label>
                                    <input type="text" class="form-control @error('contact_phone') is-invalid @enderror"
                                        id="contact_phone" name="contact_phone"
                                        value="{{ old('contact_phone', $settings->contact_phone ?? '') }}">
                                    @error('contact_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2">{{ old('address', $settings->address ?? '') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Map Eembed Url</label>
                            <textarea class="form-control @error('map_embed_url') is-invalid @enderror" id="map_embed_url" name="map_embed_url"
                                rows="2">{{ old('map_embed_url', $settings->map_embed_url ?? '') }}</textarea>
                            @error('map_embed_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="working_hours" class="form-label">Working Hours</label>
                            <input type="text" class="form-control @error('working_hours') is-invalid @enderror"
                                id="working_hours" name="working_hours"
                                value="{{ old('working_hours', $settings->working_hours ?? '') }}">
                            @error('working_hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <h6 class="mt-4">Social Media Links</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="facebook_url" class="form-label">Facebook URL</label>
                                    <input type="url" class="form-control @error('facebook_url') is-invalid @enderror"
                                        id="facebook_url" name="facebook_url"
                                        value="{{ old('facebook_url', $settings->facebook_url ?? '') }}">
                                    @error('facebook_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="twitter_url" class="form-label">Twitter URL</label>
                                    <input type="url" class="form-control @error('twitter_url') is-invalid @enderror"
                                        id="twitter_url" name="twitter_url"
                                        value="{{ old('twitter_url', $settings->twitter_url ?? '') }}">
                                    @error('twitter_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="instagram_url" class="form-label">Instagram URL</label>
                                    <input type="url"
                                        class="form-control @error('instagram_url') is-invalid @enderror"
                                        id="instagram_url" name="instagram_url"
                                        value="{{ old('instagram_url', $settings->instagram_url ?? '') }}">
                                    @error('instagram_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="linkedin_url" class="form-label">LinkedIn URL</label>
                                    <input type="url"
                                        class="form-control @error('linkedin_url') is-invalid @enderror"
                                        id="linkedin_url" name="linkedin_url"
                                        value="{{ old('linkedin_url', $settings->linkedin_url ?? '') }}">
                                    @error('linkedin_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="youtube_url" class="form-label">Youtube URL</label>
                                    <input type="url" class="form-control @error('youtube_url') is-invalid @enderror"
                                        id="youtube_url" name="youtube_url"
                                        value="{{ old('youtube_url', $settings->youtube_url ?? '') }}">
                                    @error('youtube_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <h6 class="mt-4">Media</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Site Logo</label>
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                        id="logo" name="logo" accept="image/*">
                                    @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="favicon" class="form-label">Favicon</label>
                                    <input type="file" class="form-control @error('favicon') is-invalid @enderror"
                                        id="favicon" name="favicon" accept="image/*">
                                    @error('favicon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="about_image_1" class="form-label">Home Image</label>
                                    <input type="file"
                                        class="form-control @error('about_image_1') is-invalid @enderror"
                                        id="about_image_1" name="about_image_1" accept="image/*">
                                    @error('about_image_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="about_image_2" class="form-label">About Image</label>
                                    <input type="file"
                                        class="form-control @error('about_image_2') is-invalid @enderror"
                                        id="about_image_2" name="about_image_2" accept="image/*">
                                    @error('about_image_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="hero_image_1" class="form-label">Slider 1</label>
                                    <input type="file"
                                        class="form-control @error('hero_image_1') is-invalid @enderror"
                                        id="hero_image_1" name="hero_image_1" accept="image/*">
                                    @error('hero_image_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="hero_image_2" class="form-label">Slider 2</label>
                                    <input type="file"
                                        class="form-control @error('hero_image_2') is-invalid @enderror"
                                        id="hero_image_2" name="hero_image_2" accept="image/*">
                                    @error('hero_image_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="hero_image_3" class="form-label">Slider 3</label>
                                    <input type="file"
                                        class="form-control @error('hero_image_3') is-invalid @enderror"
                                        id="hero_image_3" name="hero_image_3" accept="image/*">
                                    @error('hero_image_3')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-save"></i> Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Current Settings</h5>
                </div>
                <div class="card-body">
                    <p><strong>Site Name:</strong> {{ $settings->site_name ?? 'Not set' }}</p>
                    <p><strong>Contact Email:</strong> {{ $settings->contact_email ?? 'Not set' }}</p>
                    <p><strong>Contact Phone:</strong> {{ $settings->contact_phone ?? 'Not set' }}</p>

                    @if ($settings->logo ?? false)
                        <div class="mb-3">
                            <strong>Current Logo:</strong><br>
                            <img src="{{ asset('storage/' . $settings->logo) }}" alt="Current Logo"
                                class="img-thumbnail mt-2" style="max-height: 100px;">
                        </div>
                    @endif

                    @if ($settings->favicon ?? false)
                        <div class="mb-3">
                            <strong>Current Favicon:</strong><br>
                            <img src="{{ asset('storage/' . $settings->favicon) }}" alt="Current Favicon"
                                class="img-thumbnail mt-2" style="max-height: 32px;">
                        </div>
                    @endif
                    <hr>

                    @if ($settings->about_image_1 ?? false)
                        <div class="mb-3">
                            <strong>Home Image:</strong><br>
                            <img src="{{ asset('storage/' . $settings->about_image_1) }}" alt="Home Image"
                                class="img-thumbnail mt-2" style="max-height: 100px;">
                        </div>
                    @endif

                    @if ($settings->about_image_2 ?? false)
                        <div class="mb-3">
                            <strong>About Image:</strong><br>
                            <img src="{{ asset('storage/' . $settings->about_image_2) }}" alt="Home Image"
                                class="img-thumbnail mt-2" style="max-height: 100px;">
                        </div>
                    @endif

                    <hr>

                    @if ($settings->hero_image_1 ?? false)
                        <div class="mb-3">
                            <strong>Slider 1:</strong><br>
                            <img src="{{ asset('storage/' . $settings->hero_image_1) }}" alt="Slider 1"
                                class="img-thumbnail mt-2" style="max-height: 100px;">
                        </div>
                    @endif

                    @if ($settings->hero_image_2 ?? false)
                        <div class="mb-3">
                            <strong>Slider 2:</strong><br>
                            <img src="{{ asset('storage/' . $settings->hero_image_2) }}" alt="Slider 2"
                                class="img-thumbnail mt-2" style="max-height: 100px;">
                        </div>
                    @endif

                    @if ($settings->hero_image_3 ?? false)
                        <div class="mb-3">
                            <strong>Slider 3:</strong><br>
                            <img src="{{ asset('storage/' . $settings->hero_image_3) }}" alt="Slider 3"
                                class="img-thumbnail mt-2" style="max-height: 100px;">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if (session('status') === 'settings-updated')
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            Settings updated successfully!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
@endsection
