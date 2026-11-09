import { queryParams, type RouteQueryOptions, type RouteDefinition, type RouteFormDefinition } from './../../../../wayfinder'
/**
* @see \App\Http\Controllers\PemeriksaanController::index
 * @see app/Http/Controllers/PemeriksaanController.php:13
 * @route '/pemeriksaan'
 */
export const index = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})

index.definition = {
    methods: ["get","head"],
    url: '/pemeriksaan',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PemeriksaanController::index
 * @see app/Http/Controllers/PemeriksaanController.php:13
 * @route '/pemeriksaan'
 */
index.url = (options?: RouteQueryOptions) => {
    return index.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PemeriksaanController::index
 * @see app/Http/Controllers/PemeriksaanController.php:13
 * @route '/pemeriksaan'
 */
index.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: index.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PemeriksaanController::index
 * @see app/Http/Controllers/PemeriksaanController.php:13
 * @route '/pemeriksaan'
 */
index.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: index.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\PemeriksaanController::index
 * @see app/Http/Controllers/PemeriksaanController.php:13
 * @route '/pemeriksaan'
 */
    const indexForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: index.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\PemeriksaanController::index
 * @see app/Http/Controllers/PemeriksaanController.php:13
 * @route '/pemeriksaan'
 */
        indexForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\PemeriksaanController::index
 * @see app/Http/Controllers/PemeriksaanController.php:13
 * @route '/pemeriksaan'
 */
        indexForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: index.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    index.form = indexForm
/**
* @see \App\Http\Controllers\PemeriksaanController::create
 * @see app/Http/Controllers/PemeriksaanController.php:34
 * @route '/pemeriksaan/create'
 */
export const create = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})

create.definition = {
    methods: ["get","head"],
    url: '/pemeriksaan/create',
} satisfies RouteDefinition<["get","head"]>

/**
* @see \App\Http\Controllers\PemeriksaanController::create
 * @see app/Http/Controllers/PemeriksaanController.php:34
 * @route '/pemeriksaan/create'
 */
create.url = (options?: RouteQueryOptions) => {
    return create.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PemeriksaanController::create
 * @see app/Http/Controllers/PemeriksaanController.php:34
 * @route '/pemeriksaan/create'
 */
create.get = (options?: RouteQueryOptions): RouteDefinition<'get'> => ({
    url: create.url(options),
    method: 'get',
})
/**
* @see \App\Http\Controllers\PemeriksaanController::create
 * @see app/Http/Controllers/PemeriksaanController.php:34
 * @route '/pemeriksaan/create'
 */
create.head = (options?: RouteQueryOptions): RouteDefinition<'head'> => ({
    url: create.url(options),
    method: 'head',
})

    /**
* @see \App\Http\Controllers\PemeriksaanController::create
 * @see app/Http/Controllers/PemeriksaanController.php:34
 * @route '/pemeriksaan/create'
 */
    const createForm = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
        action: create.url(options),
        method: 'get',
    })

            /**
* @see \App\Http\Controllers\PemeriksaanController::create
 * @see app/Http/Controllers/PemeriksaanController.php:34
 * @route '/pemeriksaan/create'
 */
        createForm.get = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url(options),
            method: 'get',
        })
            /**
* @see \App\Http\Controllers\PemeriksaanController::create
 * @see app/Http/Controllers/PemeriksaanController.php:34
 * @route '/pemeriksaan/create'
 */
        createForm.head = (options?: RouteQueryOptions): RouteFormDefinition<'get'> => ({
            action: create.url({
                        [options?.mergeQuery ? 'mergeQuery' : 'query']: {
                            _method: 'HEAD',
                            ...(options?.query ?? options?.mergeQuery ?? {}),
                        }
                    }),
            method: 'get',
        })
    
    create.form = createForm
/**
* @see \App\Http\Controllers\PemeriksaanController::store
 * @see app/Http/Controllers/PemeriksaanController.php:46
 * @route '/pemeriksaan'
 */
export const store = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

store.definition = {
    methods: ["post"],
    url: '/pemeriksaan',
} satisfies RouteDefinition<["post"]>

/**
* @see \App\Http\Controllers\PemeriksaanController::store
 * @see app/Http/Controllers/PemeriksaanController.php:46
 * @route '/pemeriksaan'
 */
store.url = (options?: RouteQueryOptions) => {
    return store.definition.url + queryParams(options)
}

/**
* @see \App\Http\Controllers\PemeriksaanController::store
 * @see app/Http/Controllers/PemeriksaanController.php:46
 * @route '/pemeriksaan'
 */
store.post = (options?: RouteQueryOptions): RouteDefinition<'post'> => ({
    url: store.url(options),
    method: 'post',
})

    /**
* @see \App\Http\Controllers\PemeriksaanController::store
 * @see app/Http/Controllers/PemeriksaanController.php:46
 * @route '/pemeriksaan'
 */
    const storeForm = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
        action: store.url(options),
        method: 'post',
    })

            /**
* @see \App\Http\Controllers\PemeriksaanController::store
 * @see app/Http/Controllers/PemeriksaanController.php:46
 * @route '/pemeriksaan'
 */
        storeForm.post = (options?: RouteQueryOptions): RouteFormDefinition<'post'> => ({
            action: store.url(options),
            method: 'post',
        })
    
    store.form = storeForm
const PemeriksaanController = { index, create, store }

export default PemeriksaanController