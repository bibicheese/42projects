/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strdup.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/15 17:31:27 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/15 17:58:01 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <stdlib.h>

char	*ft_strdup(char *src)
{
	int		i;
	char	*str;

	i = 0;
	while (src[i] != '\0')
		i++;
	str = (char*)malloc(sizeof(*str) * (i + 1));
	str[i] = '\0';
	i = 0;
	while (src[i] != '\0' || str[i] != '\0')
	{
		str[i] = src[i];
		i++;
	}
	return (str);
}
