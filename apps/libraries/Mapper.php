<?php
namespace Libraries;
// use this until a better mapper is available

class Mapper
{
    /**
     * @param $source
     * @param $destination
     * @return array|null
     */
    public function Map($source, $destination)
    {
        if(empty($source) || empty($destination) )
        {
            return null;
        }
        if(is_array($source) && !is_array($destination) )
        {
            die("Destination must be a collection.");
        }

        if(!is_array($source) && is_array($destination) )
        {
            die("Source must be a collection.");
        }


        if(is_array($source) && is_array($destination) )
        {
            $arraydest = array();
            $classdestination = get_class($destination[0]);

            foreach($source as $s)
            {
                $props = get_object_vars($s);
                $odestination = new $classdestination;

                foreach($props as $i=>$v)
                {
                    if(property_exists($odestination,$i))
                    {
                        $odestination->{$i} = $v;
                    }
                }

                $arraydest[] = $odestination;

            }
            /*
            $retval = array();
            foreach($arraydest as $ad)
            {
                $ode = new $de;

                foreach($ad as $iad => $vad )
                {
                    $ode->{$iad} = $vad;
                }
                $retval[] =$ode;
            }
            */
            return $arraydest;
        }
        else
        {
            $props = get_object_vars($source);
            foreach($props as $i=>$v)
            {
                if(property_exists($destination,$i))
                {
                    $destination->{$i} = $source->{$i};
                }
            }
        }

        return $destination;
    }
}