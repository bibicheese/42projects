/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strlcat.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/08/13 22:51:45 by jmondino          #+#    #+#             */
/*   Updated: 2018/08/15 14:14:28 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

unsigned int	ft_strlcat(char *dest, char *src, unsigned int size)
{
	unsigned int i;
	unsigned int j;

	i = 0;
	j = 0;
	while (dest[i] != '\0' && i < size)
		i++;
	while (src[j] != '\0')
	{
		if (i < size)
			dest[i] = src[j];
		i++;
		j++;
	}
	dest[i] = '\0';
	return (i);
}
