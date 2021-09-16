<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v8/errors/conversion_adjustment_upload_error.proto

namespace GPBMetadata\Google\Ads\GoogleAds\V8\Errors;

class ConversionAdjustmentUploadError
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();
        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Google\Api\Http::initOnce();
        \GPBMetadata\Google\Api\Annotations::initOnce();
        $pool->internalAddGeneratedFile(
            '
�
Ggoogle/ads/googleads/v8/errors/conversion_adjustment_upload_error.protogoogle.ads.googleads.v8.errors"�
#ConversionAdjustmentUploadErrorEnum"�
ConversionAdjustmentUploadError
UNSPECIFIED 
UNKNOWN 
TOO_RECENT_CONVERSION_ACTION
INVALID_CONVERSION_ACTION 
CONVERSION_ALREADY_RETRACTED
CONVERSION_NOT_FOUND
CONVERSION_EXPIRED"
ADJUSTMENT_PRECEDES_CONVERSION!
MORE_RECENT_RESTATEMENT_FOUND
TOO_RECENT_CONVERSION	N
JCANNOT_RESTATE_CONVERSION_ACTION_THAT_ALWAYS_USES_DEFAULT_CONVERSION_VALUE
#
TOO_MANY_ADJUSTMENTS_IN_REQUEST
TOO_MANY_ADJUSTMENTSB�
"com.google.ads.googleads.v8.errorsB$ConversionAdjustmentUploadErrorProtoPZDgoogle.golang.org/genproto/googleapis/ads/googleads/v8/errors;errors�GAA�Google.Ads.GoogleAds.V8.Errors�Google\\Ads\\GoogleAds\\V8\\Errors�"Google::Ads::GoogleAds::V8::Errorsbproto3'
        , true);
        static::$is_initialized = true;
    }
}

