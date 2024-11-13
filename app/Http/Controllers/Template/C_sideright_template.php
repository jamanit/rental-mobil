<?php

namespace App\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\M_invitation;
use App\Models\M_cover;
use App\Models\M_wedding_couple;
use App\Models\M_quote;
use App\Models\M_event;
use App\Models\M_love_story;
use App\Models\M_streaming;
use App\Models\M_gift;
use App\Models\M_gift_type;
use App\Models\M_gallery;
use App\Models\M_audio;
use App\Models\M_closing;
use App\Models\M_guest;
use App\Models\M_message;

class C_sideright_template extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function edit(Request $request, string $invitation_uuid)
    {
        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;

        if ($request->ajax()) {
            $invitation_id = M_invitation::where('uuid', $invitation_uuid)->pluck('id')->first();

            $type = $request->input('type');
            if ($type === 'guests') {
                $guests = M_guest::with('invitation')->select('*')->where('invitation_id', $invitation_id)->orderBy('id', 'desc');
                return DataTables::of($guests)->make(true);
            } elseif ($type === 'messages') {
                $messages = M_message::with('invitation')->where('invitation_id', $invitation_id)->orderBy('id', 'desc');
                return DataTables::of($messages)->make(true);
            }

            $messages = M_message::with('invitation')->select('*')->orderBy('id', 'desc')->where('invitation_id', $invitation_id);
            return DataTables::of($messages)->make(true);
        } else {
            $menus      = $this->menuService->getMenus($role_id);
            $invitation = M_invitation::with([
                'template',
                'cover',
                'wedding_couple',
                'quote',
                'event',
                'love_stories',
                'streaming',
                'gifts',
                'galleries',
                'audio',
            ])->where('uuid', $invitation_uuid)->first();

            $gift_types = M_gift_type::get()
                ->mapWithKeys(function ($item) {
                    return [$item->gift_type_name => $item->gift_type_name];
                })->toArray();
        }

        return view('invitation.sideright-template.V-sideright-template', compact('menus', 'invitation', 'gift_types'));
    }

    public function action_cover(Request $request, string $uuid = null)
    {
        $section_parameter = '#cover';
        try {
            $request->validate([
                'invitation_id' => 'required|integer',
                'cover_image'   => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);

            $data = $request->except('invitation_uuid');

            if ($uuid) {
                // update
                $cover = M_cover::where('uuid', $uuid)->firstOrFail();
                if ($request->hasFile('cover_image')) {
                    if ($cover->cover_image) {
                        Storage::disk('public')->delete($cover->cover_image);
                    }
                    $data['cover_image'] = $request->file('cover_image')->store('cover', 'public');
                }
                $cover->update($data);
                $message = 'Data berhasil diperbarui.';
            } else {
                // store
                if ($request->hasFile('cover_image')) {
                    $data['cover_image'] = $request->file('cover_image')->store('cover', 'public');
                }
                M_cover::create($data);
                $message = 'Data berhasil ditambahkan.';
            }

            return redirect()->route('invitations.sideright-template.edit', $request->invitation_uuid .  $section_parameter)->with('success' . $section_parameter, $message);
        } catch (ValidationException $e) {
            return redirect()->to(url()->previous() . $section_parameter)->with('error' . $section_parameter, 'Data gagal diproses, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function action_wedding_couple(Request $request, string $uuid = null)
    {
        $section_parameter = '#wedding_couple';
        try {
            $rules = [
                'invitation_id'      => 'required|integer',
                'opening_greeting'   => 'required|string|max:255',
                'text_greeting'      => 'required|string',
                'bride_full_name'    => 'required|string|max:255',
                'bride_nickname'     => 'required|string|max:255',
                'bride_child_number' => 'required|string|max:255',
                'bride_mother_name'  => 'required|string|max:255',
                'bride_father_name'  => 'required|string|max:255',
                'groom_full_name'    => 'required|string|max:255',
                'groom_nickname'     => 'required|string|max:255',
                'groom_child_number' => 'required|string|max:255',
                'groom_mother_name'  => 'required|string|max:255',
                'groom_father_name'  => 'required|string|max:255',
            ];
            if ($uuid) {
                $rules['bride_photo'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120';
                $rules['groom_photo'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120';
            } else {
                $rules['bride_photo'] = 'required|image|mimes:jpeg,png,jpg,gif|max:5120';
                $rules['groom_photo'] = 'required|image|mimes:jpeg,png,jpg,gif|max:5120';
            }
            $request->validate($rules);

            $data = $request->except('invitation_uuid');

            if ($uuid) {
                // update
                $wedding_couple = M_wedding_couple::where('uuid', $uuid)->firstOrFail();
                if ($request->hasFile('bride_photo')) {
                    if ($wedding_couple->bride_photo) {
                        Storage::disk('public')->delete($wedding_couple->bride_photo);
                    }
                    $data['bride_photo'] = $request->file('bride_photo')->store('wedding_couple', 'public');
                }
                if ($request->hasFile('groom_photo')) {
                    if ($wedding_couple->groom_photo) {
                        Storage::disk('public')->delete($wedding_couple->groom_photo);
                    }
                    $data['groom_photo'] = $request->file('groom_photo')->store('wedding_couple', 'public');
                }
                $wedding_couple->update($data);
                $message = 'Data berhasil diperbarui.';
            } else {
                // store
                if ($request->hasFile('bride_photo')) {
                    $data['bride_photo'] = $request->file('bride_photo')->store('wedding_couple', 'public');
                }
                if ($request->hasFile('groom_photo')) {
                    $data['groom_photo'] = $request->file('groom_photo')->store('wedding_couple', 'public');
                }
                M_wedding_couple::create($data);
                $message = 'Data berhasil ditambahkan.';
            }

            return redirect()->route('invitations.sideright-template.edit', $request->invitation_uuid .  $section_parameter)->with('success' . $section_parameter, $message);
        } catch (ValidationException $e) {
            return redirect()->to(url()->previous() . $section_parameter)->with('error' . $section_parameter, 'Data gagal diproses, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function action_quote(Request $request, string $uuid = null)
    {
        $section_parameter = '#quote';
        try {
            $rules = [
                'invitation_id' => 'required|integer',
                'quote_text'    => 'required|string',
            ];
            if ($uuid) {
                $rules['background_image_1'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120';
                $rules['background_image_2'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120';
                $rules['background_image_3'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120';
            } else {
                $rules['background_image_1'] = 'required|image|mimes:jpeg,png,jpg,gif|max:5120';
                $rules['background_image_2'] = 'required|image|mimes:jpeg,png,jpg,gif|max:5120';
                $rules['background_image_3'] = 'required|image|mimes:jpeg,png,jpg,gif|max:5120';
            }
            $request->validate($rules);

            $data = $request->except('invitation_uuid');

            if ($uuid) {
                // update
                $quote = M_quote::where('uuid', $uuid)->firstOrFail();
                if ($request->hasFile('background_image_1')) {
                    if ($quote->background_image_1) {
                        Storage::disk('public')->delete($quote->background_image_1);
                    }
                    $data['background_image_1'] = $request->file('background_image_1')->store('quote', 'public');
                }
                if ($request->hasFile('background_image_2')) {
                    if ($quote->background_image_2) {
                        Storage::disk('public')->delete($quote->background_image_2);
                    }
                    $data['background_image_2'] = $request->file('background_image_2')->store('quote', 'public');
                }
                if ($request->hasFile('background_image_3')) {
                    if ($quote->background_image_3) {
                        Storage::disk('public')->delete($quote->background_image_3);
                    }
                    $data['background_image_3'] = $request->file('background_image_3')->store('quote', 'public');
                }
                $quote->update($data);
                $message = 'Data berhasil diperbarui.';
            } else {
                // store
                if ($request->hasFile('background_image_1')) {
                    $data['background_image_1'] = $request->file('background_image_1')->store('quote', 'public');
                }
                if ($request->hasFile('background_image_2')) {
                    $data['background_image_2'] = $request->file('background_image_2')->store('quote', 'public');
                }
                if ($request->hasFile('background_image_3')) {
                    $data['background_image_3'] = $request->file('background_image_3')->store('quote', 'public');
                }
                M_quote::create($data);
                $message = 'Data berhasil ditambahkan.';
            }

            return redirect()->route('invitations.sideright-template.edit', $request->invitation_uuid .  $section_parameter)->with('success' . $section_parameter, $message);
        } catch (ValidationException $e) {
            return redirect()->to(url()->previous() . $section_parameter)->with('error' . $section_parameter, 'Data gagal diproses, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function action_event(Request $request, string $uuid = null)
    {
        $section_parameter = '#event';
        try {
            $request->validate([
                'event_type_1' => 'nullable|string|max:255',
                'event_date_1' => 'nullable|string|max:255',
                'location_1'   => 'nullable|string|max:255',
                'address_1'    => 'nullable|string|max:255',
                'map_url_1'    => 'nullable|url',
                'event_type_2' => 'nullable|string|max:255',
                'event_date_2' => 'nullable|string|max:255',
                'location_2'   => 'nullable|string|max:255',
                'address_2'    => 'nullable|string|max:255',
                'map_url_2'    => 'nullable|url',
                'event_type_3' => 'nullable|string|max:255',
                'event_date_3' => 'nullable|string|max:255',
                'location_3'   => 'nullable|string|max:255',
                'address_3'    => 'nullable|string|max:255',
                'map_url_3'    => 'nullable|url',
            ]);

            $data = $request->except('invitation_uuid');

            if ($uuid) {
                // update
                $event = M_event::where('uuid', $uuid)->firstOrFail();
                $event->update($data);
                $message = 'Data berhasil diperbarui.';
            } else {
                // store
                M_event::create($data);
                $message = 'Data berhasil ditambahkan.';
            }

            return redirect()->route('invitations.sideright-template.edit', $request->invitation_uuid .  $section_parameter)->with('success' . $section_parameter, $message);
        } catch (ValidationException $e) {
            return redirect()->to(url()->previous() . $section_parameter)->with('error' . $section_parameter, 'Data gagal diproses, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function action_love_story(Request $request, string $uuid = null)
    {
        $section_parameter = '#love_story';
        try {
            $data = $request->except('invitation_uuid');
            if ($uuid) {
                // delete
                $love_story = M_love_story::where('uuid', $uuid)->firstOrFail();
                $love_story->delete();
                $message = 'Data berhasil dihapus.';
            } else {
                // store
                $request->validate([
                    'title' => 'required|string|max:255',
                    'story' => 'required|string',
                ]);
                M_love_story::create($data);
                $message = 'Data berhasil ditambahkan.';
            }

            return redirect()->route('invitations.sideright-template.edit', $request->invitation_uuid .  $section_parameter)->with('success' . $section_parameter, $message);
        } catch (ValidationException $e) {
            return redirect()->to(url()->previous() . $section_parameter)->with('error' . $section_parameter, 'Data gagal diproses, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function action_streaming(Request $request, string $uuid = null)
    {
        $section_parameter = '#streaming';
        try {
            $request->validate([
                'youtube_url_id' => 'required|string',
            ]);

            $data = $request->except('invitation_uuid');

            if ($uuid) {
                // update
                $streaming = M_streaming::where('uuid', $uuid)->firstOrFail();
                $streaming->update($data);
                $message = 'Data berhasil diperbarui.';
            } else {
                // store
                M_streaming::create($data);
                $message = 'Data berhasil ditambahkan.';
            }

            return redirect()->route('invitations.sideright-template.edit', $request->invitation_uuid .  $section_parameter)->with('success' . $section_parameter, $message);
        } catch (ValidationException $e) {
            return redirect()->to(url()->previous() . $section_parameter)->with('error' . $section_parameter, 'Data gagal diproses, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function action_gift(Request $request, string $uuid = null)
    {
        $section_parameter = '#gift';
        try {
            $data = $request->except('invitation_uuid');
            if ($uuid) {
                // delete
                $gift = M_gift::where('uuid', $uuid)->firstOrFail();
                $gift->delete();
                $message = 'Data berhasil dihapus.';
            } else {
                // store
                $request->validate([
                    'gift_type_name'         => 'required|string|max:255',
                    'account_name'           => 'nullable|string|max:255',
                    'account_number'         => 'nullable|string|max:255',
                    'account_holder'         => 'nullable|string|max:255',
                    'recipient_name'         => 'nullable|string|max:255',
                    'recipient_phone_number' => 'nullable|string|max:255',
                    'recipient_address'      => 'nullable|string|max:255',
                ]);
                M_gift::create($data);
                $message = 'Data berhasil ditambahkan.';
            }

            return redirect()->route('invitations.sideright-template.edit', $request->invitation_uuid .  $section_parameter)->with('success' . $section_parameter, $message);
        } catch (ValidationException $e) {
            return redirect()->to(url()->previous() . $section_parameter)->with('error' . $section_parameter, 'Data gagal diproses, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function action_gallery(Request $request, string $uuid = null)
    {
        $section_parameter = '#gallery';
        try {
            $data = $request->except('invitation_uuid');

            if ($uuid) {
                // delete
                $gallery = M_gallery::where('uuid', $uuid)->firstOrFail();
                $gallery->delete();
                $message = 'Data berhasil dihapus.';
            } else {
                // Store
                $uploadedCount = M_gallery::where('invitation_id', $request->invitation_id)->count();
                if ($uploadedCount >= 10) {
                    return redirect()->route('invitations.sideright-template.edit', $request->invitation_uuid . $section_parameter)
                        ->with('error' . $section_parameter, 'Kamu hanya bisa mengunggah maksimal 10 file.');
                }

                $request->validate([
                    'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                ]);

                if ($request->hasFile('photo')) {
                    $data['photo'] = $request->file('photo')->store('gallery', 'public');
                }

                M_gallery::create($data);
                $message = 'Data berhasil ditambahkan.';
            }

            return redirect()->route('invitations.sideright-template.edit', $request->invitation_uuid . $section_parameter)
                ->with('success' . $section_parameter, $message);
        } catch (ValidationException $e) {
            return redirect()->to(url()->previous() . $section_parameter)->with('error' . $section_parameter, 'Data gagal diproses, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function action_audio(Request $request, string $uuid = null)
    {
        $section_parameter = '#audio';
        try {
            $request->validate([
                'audio_file' => 'required|file|mimes:mp3,wav,ogg|max:10240',
            ]);

            $data = $request->except('invitation_uuid');

            if ($uuid) {
                // update
                $audio = M_audio::where('uuid', $uuid)->firstOrFail();
                if ($request->hasFile('audio_file')) {
                    if ($audio->audio_file) {
                        Storage::disk('public')->delete($audio->audio_file);
                    }
                    $data['audio_file'] = $request->file('audio_file')->store('audio', 'public');
                }
                $audio->update($data);
                $message = 'Data berhasil diperbarui.';
            } else {
                // store
                if ($request->hasFile('audio_file')) {
                    $data['audio_file'] = $request->file('audio_file')->store('audio', 'public');
                }
                M_audio::create($data);
                $message = 'Data berhasil ditambahkan.';
            }

            return redirect()->route('invitations.sideright-template.edit', $request->invitation_uuid .  $section_parameter)->with('success' . $section_parameter, $message);
        } catch (ValidationException $e) {
            return redirect()->to(url()->previous() . $section_parameter)->with('error' . $section_parameter, 'Data gagal diproses, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function action_closing(Request $request, string $uuid = null)
    {
        $section_parameter = '#closing';
        try {
            $request->validate([
                'closing_text'     => 'required|string',
                'closing_greeting' => 'required|string|max:255',
            ]);

            $data = $request->except('invitation_uuid');

            if ($uuid) {
                // update
                $closing = M_closing::where('uuid', $uuid)->firstOrFail();
                $closing->update($data);
                $message = 'Data berhasil diperbarui.';
            } else {
                // store
                M_closing::create($data);
                $message = 'Data berhasil ditambahkan.';
            }

            return redirect()->route('invitations.sideright-template.edit', $request->invitation_uuid .  $section_parameter)->with('success' . $section_parameter, $message);
        } catch (ValidationException $e) {
            return redirect()->to(url()->previous() . $section_parameter)->with('error' . $section_parameter, 'Data gagal diproses, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function play_audio($directory, $filename)
    {
        $filePath = "{$directory}/{$filename}";
        if (!Storage::disk('public')->exists($filePath)) {
            abort(404);
        }

        return response()->stream(function () use ($filePath) {
            echo Storage::disk('public')->get($filePath);
        }, 200, [
            'Content-Type'        => 'audio/mpeg',
            'Content-Disposition' => 'inline; filename="' . basename($filePath) . '"',
            'Accept-Ranges'       => 'bytes',
        ]);
    }

    public function action_guest(Request $request, string $uuid = null)
    {
        $section_parameter = '#guest';
        try {
            $data = $request->except('invitation_uuid');

            if ($uuid) {
                // delete 
                $guest = M_guest::where('uuid', $uuid)->firstOrFail();
                $guest->delete();
                $message = 'Data berhasil dihapus.';
            } else {
                // Store 
                $request->validate([
                    'guest_name' => 'required|string|max:255',
                ]);

                M_guest::create($data);
                $message = 'Data berhasil ditambahkan.';
            }

            return redirect()->route('invitations.sideright-template.edit', $request->invitation_uuid . $section_parameter)
                ->with('success' . $section_parameter, $message);
        } catch (ValidationException $e) {
            return redirect()->to(url()->previous() . $section_parameter)->with('error' . $section_parameter, 'Data gagal diproses, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function action_message(Request $request, string $uuid = null)
    {
        $section_parameter = '#message';
        try {
            if ($uuid) {
                // delete 
                $message = M_message::where('uuid', $uuid)->firstOrFail();
                $message->delete();
                $message = 'Data berhasil dihapus.';
            }

            return redirect()->route('invitations.sideright-template.edit', $request->invitation_uuid . $section_parameter)
                ->with('success' . $section_parameter, $message);
        } catch (ValidationException $e) {
            return redirect()->to(url()->previous() . $section_parameter)->with('error' . $section_parameter, 'Data gagal diproses, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function send_message(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'invitation_id'    => 'required|integer',
            'name'             => 'required|string|max:255',
            'message'          => 'required|string|max:500',
            'presence_confirm' => 'nullable|string|max:255',
            'guest_totals'     => 'nullable|numeric|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
            ], 400);
        }

        $message                   = new M_message();
        $message->invitation_id    = $request->invitation_id;
        $message->name             = $request->name;
        $message->message          = $request->message;
        $message->presence_confirm = $request->presence_confirm;
        $message->guest_totals     = $request->guest_totals;
        $message->save();

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim!',
            'data'    => $message,
        ]);
    }

    public function get_message(string $invitation_id)
    {
        $messages = M_message::orderBy('created_at', 'desc')->where('invitation_id', $invitation_id)->take(10)->get();

        return response()->json($messages);
    }
}
