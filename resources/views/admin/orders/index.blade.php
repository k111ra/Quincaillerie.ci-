@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Commandes - Administration')

@section('content')
    <div class="container">
        <h6 class="text-muted">Commandes Organisées par Statut</h6>
        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                @php
                    $statuses = ['pending', 'shipped', 'completed', 'cancelled'];
                @endphp
                @foreach ($statuses as $index => $status)
                    <li class="nav-item">
                        <button type="button" class="nav-link @if ($index == 0) active @endif" role="tab"
                            data-bs-toggle="tab" data-bs-target="#{{ $status }}" aria-controls="{{ $status }}"
                            aria-selected="{{ $index == 0 ? 'true' : 'false' }}">
                            <i class="tf-icons bx bx-list-ul"></i>
                            {{ ucfirst($status) }}
                            <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">
                                {{ isset($ordersByStatus[$status]) ? $ordersByStatus[$status]->count() : 0 }}
                            </span>
                        </button>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content">
                @foreach ($statuses as $index => $status)
                    <div class="tab-pane fade @if ($index == 0) show active @endif" id="{{ $status }}"
                        role="tabpanel">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Commande ID</th>
                                        <th>Utilisateur</th>
                                        <th>Montant Total</th>
                                        <th>Date de Création</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($ordersByStatus[$status]))
                                        @foreach ($ordersByStatus[$status] as $order)
                                            <tr>
                                                <td><strong>#{{ $order->order_number }}</strong></td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>{{ number_format($order->total_amount, 0) }} F CFA</td>
                                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.orders.edit', $order->id) }}">
                                                                <i class="bx bx-edit-alt me-1"></i> Modifier
                                                            </a>
                                                            <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item">
                                                                    <i class="bx bx-trash me-1"></i> Supprimer
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">Aucune commande {{ ucfirst($status) }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
