<?php 
class Posts {
    
    private static $argsQuery;
    private static $postObject;

    protected $wpQuery = false; // default false

    protected $Error;
    protected $Success;

    public static function singlePost( int $id )
    {
        self::$postObject = new singlePost( $id );
        return self::$postObject;
    }

    public static function getAll( $postTypes = 'post' )
    {
        self::$argsQuery['post_type'] = $postTypes;
        return new self;
    }

    public function setQuery( array $setQuery = [] )
    {
        self::$argsQuery = array_merge( self::$argsQuery, $setQuery );
        return new self;
    }

    public function get()
    {
        if ( ! isset ( self::$argsQuery['post_status'] ) ) {
            self::$argsQuery['post_status'] = 'publish'; // default 
        }
        if ( ! isset ( self::$argsQuery['posts_per_page'] ) ) {
            self::$argsQuery['posts_per_page'] = get_option( 'posts_per_page' ); // default 
        }
        $this->wpQuery = new WP_Query( self::$argsQuery );
        if ( $this->wpQuery->have_posts() ) {
            $this->reset();
            return $this->wpQuery;
        } else {
            return false;
        }
    }

    public static function reset()
    {
        $resetArgs = isset ( self::$argsQuery ) ? self::$argsQuery : '';
        if ( ! empty ( $resetArgs ) ) {
            foreach ( $resetArgs as $key => $reset ) {
                unset( self::$argsQuery[$key] );
            }
        }
    }
}