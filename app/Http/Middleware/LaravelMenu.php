<?php

namespace App\Http\Middleware;

use Closure;
use Laratrust;
use Menu;

class LaravelMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //左側
        Menu::make('left', function ($menu) {
            /* @var \Lavary\Menu\Builder $menu */
            //$menu->add('Home', ['route' => 'index']);
            //$menu->add('About', 'javascript:void(0)');
            //$menu->add('Contact', 'javascript:void(0)');
        });
        //右側
        Menu::make('right', function ($menu) {
            /* @var \Lavary\Menu\Builder $menu */
            $menu->add('成員清單', ['route' => 'user-profile.index'])->active('user-profile/*');
            $menu->add('研究計畫', ['route' => 'research-project.index'])->active('research-project/*');
            $academicEventMenu = $menu->add('學術活動', 'javascript:void(0)');
            $academicEventMenu->add('擔任國內外學術期刊編輯委員', ['route' => 'academic-event-journal-editor.index'])
                ->active('academic-event-journal-editor/*');
            $academicEventMenu->add('擔任國內外學術研討會議程委員', ['route' => 'academic-event-agenda-member.index'])
                ->active('academic-event-agenda-member/*');
            $academicEventMenu->add('擔任國內外學術研討會議程主持人', ['route' => 'academic-event-seminar-host.index'])
                ->active('academic-event-seminar-host/*');
            $academicEventMenu->add('擔任國際學術期刊之論文評審委員', ['route' => 'academic-event-paper-committee.index'])
                ->active('academic-event-paper-committee/*');
            $academicEventMenu->add('應聘擔任國內重要委員會委員', ['route' => 'academic-event-committee-member.index'])
                ->active('academic-event-committee-member/*');
            $academicEventMenu->add('學術演講', ['route' => 'academic-speech.index'])
                ->active('academic-speech/*');
            $academicEventMenu->add('學術榮耀', ['route' => 'academic-honor.index'])
                ->active('academic-honor/*');
            //會員
            if (auth()->check()) {
                if (!auth()->user()->is_confirmed) {
                    $menu->add('尚未完成信箱驗證', ['route' => 'confirm-mail.resend'])
                        ->link->attr(['class' => 'text-danger']);
                }
                //管理員
                if (Laratrust::can('menu.view') and auth()->user()->isConfirmed) {
                    /** @var \Lavary\Menu\Builder $adminMenu */
                    $adminMenu = $menu->add('管理選單', 'javascript:void(0)');

                    if (Laratrust::can(['user.manage', 'user.view'])) {
                        $adminMenu->add('會員清單', ['route' => 'user.index'])->active('user/*');
                    }

                    if (Laratrust::can('role.manage')) {
                        $adminMenu->add('角色管理', ['route' => 'role.index']);
                    }

                    if (Laratrust::can('setting.manage')) {
                        $adminMenu->add('網站設定', ['route' => 'setting.edit']);
                    }

                    if (Laratrust::can('log-viewer.access')) {
                        $adminMenu->add(
                            '記錄檢視器 <i class="fas fa-external-link-alt" aria-hidden="true"></i>',
                            ['route' => 'log-viewer::dashboard']
                        )->link->attr('target', '_blank');
                    }
                }
                /** @var \Lavary\Menu\Builder $userMenu */
                $userMenu = $menu->add(auth()->user()->name, 'javascript:void(0)');
                $userMenu->add('個人資料', ['route' => 'profile'])->active('profile/*');
                $userMenu->add('登出', ['route' => 'logout']);
            } else {
                //遊客
                $menu->add('登入', ['route' => 'login']);
            }
        });

        return $next($request);
    }
}
